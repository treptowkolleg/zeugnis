<?php

namespace App\Domain\GeR\Enum;

enum GeRLevel: string
{
    case A1 = "A1";
    case A2 = "A2";
    case A2_B1 = "A2/B1";
    case B1 = "B1";
    case B1_B2 = "B1/B2";
    case B2 = "B2";
    case B2_C1 = "B2/C1";
    case C1 = "C1";
    case NONE = "-";

}
