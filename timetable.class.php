<?php
require("lesson.class.php");
require("cell.class.php");

class Timetable
{
    private array $timetable = [];
    public array $minMax = [];
    public function __construct()
    {
        $data = json_decode(file_get_contents("./timetable.json"));
        Lesson::setStaticProperty('teachers', $data->teachers);
        Lesson::setStaticProperty('lessons', $data->lessons);
        Lesson::setStaticProperty('hours', $data->hours);
        $this->minMax = Timetable::getFirstLastLesson($data->timetable);

        $timetable = [[], [], [], [], []];
        for ($i = 0; $i < count($data->timetable); $i++) {
            $day = $data->timetable[$i]->lessons;
            for ($j = $this->minMax[0]; $j <= $this->minMax[1]; $j++) {
                $element = null;
                if (count($day) > 0 && $day[0][0]->hourId == $j) {
                    $element = new Cell($day[0]);
                    array_shift($day);
                }
                $timetable[$i][$j] = $element;
            }
        }
        $this->timetable = $timetable;
        // var_dump($timetable);
    }
    public function __get($name)
    {
        if (property_exists($this, $name))
            return $this->$name;
        else
            throw new Exception("Property {$name} does not exist.");
    }
    private static function getFirstLastLesson(array $days)
    {
        $min = 2147483647;
        $max = -2147483647;

        foreach ($days as $day) {
            for ($i = 0; $i < count($day->lessons); $i++) {
                foreach ($day->lessons[$i] as $lesson) {
                    if ($lesson->hourId < $min)
                        $min = $lesson->hourId;
                    if ($lesson->hourId > $max)
                        $max = $lesson->hourId;
                }
            }
        }
        return [$min, $max];
    }
}
