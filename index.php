<?php
require("timetable.class.php");

$days = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
$timetable = new Timetable();

function printCell(?Cell $cell)
{
    if ($cell == null) {
        return "<div class='bg-gray-100 outline outline-gray-100'></div>";
    }

    $result = "<div class='flex flex-col p-1 outline divide-y divide-black'>";
    foreach ($cell->cell as $lesson) {
        $result .= "<div class='flex flex-col flex-1'>";
        $result .= "<div class='flex justify-between'>";
        $result .= "<p>{$lesson->classroom}</p>";
        $result .= "<h3>{$lesson->teacherAbr}</h3>";
        $result .= "</div>";
        $result .= "<h2 class='font-medium text-lg flex-1 place-self-center'>{$lesson->lessonAbr}</h2>";
        $result .= "</div>";
    }
    $result .= "</div>";
    return $result;
}
?>
<!DOCTYPE html>
<html lang="cz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rozvrh</title>
</head>

<body>
    <div class="grid grid-cols-<?php echo $timetable->minMax[1] - $timetable->minMax[0] + 1; ?> gap-2 *:aspect-square select-none -mt-24 w-11/12">
        <div></div>
        <?php for ($i = $timetable->minMax[0]; $i < $timetable->minMax[1]; $i++): ?>
            <div class="flex font-bold items-end justify-center"><?= $i ?></div>
        <?php endfor; ?>

        <?php foreach ($timetable->timetable as $dayIndex => $day): ?>
            <div class="font-bold flex items-center justify-center"><?= $days[$dayIndex] ?></div>
            <?php for ($j = $timetable->minMax[0]; $j < $timetable->minMax[1]; $j++): ?>
                <?= printCell($day[$j] ?? null) ?>
            <?php endfor; ?>
        <?php endforeach; ?>
    </div>
</body>

</html>