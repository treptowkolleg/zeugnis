<?php

namespace App\Domain\Language\Model;

use App\Domain\Course\Enum\Semester;
use App\Domain\Language\Enum\Language;
use App\Domain\Language\Enum\LanguageType;

class LanguageTrajectory
{

    private readonly Language $language;
    private readonly LanguageType $type;
    private Semester $semester;

    public function __construct(Language $language, LanguageType $type, Semester $lastSemester)
    {
        $this->language = $language;
        $this->type = $type;
        $this->semester = $lastSemester;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getType(): LanguageType
    {
        return $this->type;
    }

    public function getSemester(): Semester
    {
        return $this->semester;
    }

    public function setSemester(Semester $semester): void
    {
        $this->semester = $semester;
    }

}