<?php

namespace App\Domain\Language\Enum;

enum LanguageType: string
{
    case Primary_FS = "1. Fremdsprache";
    case Secondary_FS  = "2./3. fortgeführte Fremdsprache";
    case Initial_FS = "neu einsetzende Fremdsprache";

    public function toString(): string
    {
        return $this->value;
    }

}
