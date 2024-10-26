# ROZVRH

- [ROZVRH](#rozvrh)
  - [About ](#about-)
  - [Theory ](#theory-)
    - [Typování v PHP](#typování-v-php)
    - [Objektový model v PHP](#objektový-model-v-php)
    - [Třídy a objekty](#třídy-a-objekty)
  - [Dědičnost](#dědičnost)
  - [Zapouzdření](#zapouzdření)
    - [Dynamické typování](#dynamické-typování)
    - [Type hinting](#type-hinting)
  - [Key Functions ](#key-functions-)
  - [Solution Explanation ](#solution-explanation-)
    - [Struktura tříd](#struktura-tříd)
  - [Overview ](#overview-)

## About <a name = "about"></a>

Tento projekt slouží k vytvoření a zobrazení rozvrhu. Rozvrh je generován pomocí PHP na základě dat uložených v JSON souboru.

## Theory <a name = "theory"></a>

### Typování v PHP
PHP je dynamicky typovaný jazyk, což znamená, že proměnné nemusí mít předem definovaný typ. V tomto projektu je však možné určit typ argumentů a návratových hodnot, což přispívá k větší bezpečnosti kódu. 

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

### Třídy a objekty
Třída je šablona pro vytváření objektů.


```php
class Lesson
{
    private static array $teachers = [], $lessons = [], $hours = [];
    private int $classroom;
    private string $teacherName, $teacherAbr, $lessonName, $lessonAbr;
}
```

Tato třída umožňuje vytvoření instance Lesson s konkrétními údaji o lekci.

## Dědičnost
V rámci tohoto projektu nedochází k přímé ukázce dědičnosti, ale je to důležitý koncept, který můžete použít k rozšíření funkcionality tříd. Například, pokud byste chtěli vytvořit specializovanou třídu OnlineLesson, mohla by dědit vlastnosti z Lesson a přidat nové.

## Zapouzdření
Ochrana interních dat třídy je zajištěna pomocí modifikátorů viditelnosti. Například vlastnosti třídy Lesson jsou private, což znamená, že k nim lze přistupovat pouze prostřednictvím veřejných metod

```php
public function __get($name)
{
    if (property_exists($this, $name))
        return $this->$name;
    else
        throw new Exception("Property {$name} does not exist.");
}
```
Tímto způsobem chráníte interní logiku a zajišťujete, že externí kód nemůže přímo měnit vlastnosti bez použití definovaných metod.

### Dynamické typování
PHP je dynamicky typovaný jazyk, což znamená, že proměnné nemusí mít předem definovaný typ. Například ve třídě Lesson je definováno několik proměnných jako int a string, ale jejich typy jsou určeny až přiřazením hodnot v konstruktoru

```php
private int $classroom;
private string $teacherName, $teacherAbr, $lessonName, $lessonAbr;
```

### Type hinting
PHP 7 a novější verze umožňují určování typů argumentů a návratových hodnot. V konstruktoru třídy Cell se jako argument očekává pole

```php
public function __construct(array $cell)
{
    foreach ($cell as $lesson) {
        array_push($this->cell, new Lesson($lesson));
    }
}
```

Zde je jasně specifikováno, že parametr $cell musí být typu array, což zajišťuje, že do konstruktoru lze předat pouze platné datové struktury.


## Key Functions <a name = "key-functions"></a>
Projekt využívá několik důležitých funkcí pro práci s poli

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

### Struktura tříd
 - Lesson: Uchovává informace o lekcích.
 - Cell: Spravuje více lekcí, které jsou v jednom časovém slotu.
 - Timetable: Zpracovává celý rozvrh, načítá data a určuje rozmezí hodin v rozvrhu (první a poslední hodina).

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