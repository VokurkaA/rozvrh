<?php

class Cell
{
    public array $cell = [];
    public function __construct(array $cell)
    {
        foreach ($cell as $lesson) {
            array_push($this->cell, new Lesson($lesson));
        }
    }
}
