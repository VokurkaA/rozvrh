# ROZVRH

- [ROZVRH](#rozvrh)
  - [About ](#about-)
  - [Theory ](#theory-)
    - [Typování v PHP](#typování-v-php)
    - [Objektový model v PHP](#objektový-model-v-php)
  - [Key Functions ](#key-functions-)
  - [Solution Explanation ](#solution-explanation-)
    - [Struktura tříd:](#struktura-tříd)
  - [Overview ](#overview-)

## About <a name = "about"></a>

Tento projekt slouží k vytvoření a zobrazení rozvrhu. Rozvrh je generován pomocí PHP na základě dat uložených v JSON souboru.

## Theory <a name = "theory"></a>

### Typování v PHP
PHP je dynamicky typovaný jazyk, což znamená, že proměnné nemusí mít předem definovaný typ. V tomto projektu je však možné určit typ argumentů a návratových hodnot, což přispívá k větší bezpečnosti kódu. Příklad typování v metodě:

```php
public function __construct(object $lesson)
```
Zde je argument lesson definován jako objekt, což zaručuje, že funkce dostane očekávaný typ dat.

### Objektový model v PHP
Projekt využívá objektově orientovaný přístup, který umožňuje zapouzdření a lepší strukturování kódu. Například třída Lesson reprezentuje lekce a uchovává data jako učitelé a předměty, zatímco třída Cell spravuje buňky rozvrhu, které mohou obsahovat více lekcí.

```php
class Lesson {
    private string $teacherName;
    private string $lessonAbr;

    public function __construct(object $lesson) {
        $this->teacherName = Lesson::$teachers[$lesson->teacherId]->name;
        $this->lessonAbr = Lesson::$lessons[$lesson->lessonId]->abbrev;
    }
}
```
## Key Functions <a name = "key-functions"></a>
Projekt využívá několik důležitých funkcí pro práci s poli:

array_push(): Přidává lekce do buňky rozvrhu.

```php
array_push($this->cell, new Lesson($lesson));
```

array_shift(): Odstraňuje první prvek pole (např. při iteraci přes lekce dne).

```php
array_shift($day);
```

foreach: Prochází pole s lekcemi a dny rozvrhu.

```php
foreach ($days as $dayIndex => $day)
```

## Solution Explanation <a name = "solution-explanation"></a>
Projekt je navržen tak, aby z JSON souboru načetl data o lekcích, učitelích a třídách a zobrazil je na stránce.

### Struktura tříd:
 - Lesson: Uchovává informace o lekcích.
 - Cell: Spravuje více lekcí, které jsou v jednom časovém slotu.
 - Timetable: Zpracovává celý rozvrh, načítá data a určuje rozmezí hodin v rozvrhu (první a poslední hodina).

Příklad zobrazení jedné buňky v rozvrhu:

```php
function printCell(?Cell $cell) {
    if ($cell == null) return "<div class='bg-gray-100'></div>";
    foreach ($cell->cell as $lesson) {
        echo "<div><h2>{$lesson->lessonAbr}</h2></div>";
    }
}
```

## Overview <a name="overview"></a>

```
rozvrh
├─ cell.class.php
├─ index.php
├─ lesson.class.php
├─ README.md
├─ timetable.class.php
└─ timetable.json
```