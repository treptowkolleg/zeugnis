<?php

namespace App\Domain\Course\Enum;

enum Semester: string
{
    case VK = "Vorkurs";
    case EP = "Einführungsphase";
    case Q1 = "1. Semester der Qualifikationsphase";
    case Q2 = "2. Semester der Qualifikationsphase";
    case Q3 = "3. Semester der Qualifikationsphase";
    case Q4 = "4. Semester der Qualifikationsphase";

}
