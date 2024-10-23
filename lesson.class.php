<?php

class Lesson
{
    private static array $teachers = [], $lessons = [], $hours = [];
    private int $classroom;
    private string $teacherName, $teacherAbr, $lessonName, $lessonAbr;


    public function __construct(object $lesson)
    {   
        $this->teacherName = Lesson::$teachers[$lesson->teacherId]->name;
        $this->teacherAbr = Lesson::$teachers[$lesson->teacherId]->abbrev;
        
        $this->lessonName = Lesson::$lessons[$lesson->lessonId]->name;
        $this->lessonAbr = Lesson::$lessons[$lesson->lessonId]->abbrev;

        $this->classroom = $lesson->classroom;
        // var_dump($this);
    }

    public function __get($name)
    {
        if (property_exists($this, $name))
            return $this->$name;
        else
            throw new Exception("Property {$name} does not exist.");
    }
    public static function setStaticProperty(string $name, $value)
    {
        if ($name === 'teachers' || $name === 'lessons' || $name === 'hours') {
            self::$$name = $value;
        } else {
            throw new Exception("Property {$name} is not accessible.");
        }
    }    
}
