<?php

namespace App\Domain\GeR\Resolver;

use App\Domain\Course\Enum\Semester;
use App\Domain\GeR\Enum\GeRLevel;
use App\Domain\Language\Enum\Language;
use App\Domain\Language\Enum\LanguageType;
use App\Domain\Language\Model\LanguageTrajectory;

class GeRLevelResolver
{
    public function resolve(LanguageTrajectory $trajectory): GeRLevel
    {
        $isEnglish = $trajectory->getLanguage() == Language::English;

        if ($trajectory->getLanguage() == Language::Latin)
            return GeRLevel::NONE;

        return match ($trajectory->getType()) {
            LanguageType::Primary_FS => match ($trajectory->getSemester()) {
                Semester::VK                => GeRLevel::NONE,
                Semester::EP, Semester::Q1  => GeRLevel::B1,
                Semester::Q2, Semester::Q3  => GeRLevel::B2,
                Semester::Q4                => $isEnglish ? GeRLevel::B2_C1 : GeRLevel::B2,
            },
            LanguageType::Secondary_FS => match ($trajectory->getSemester()) {
                Semester::VK                => GeRLevel::NONE,
                Semester::EP, Semester::Q1  => GeRLevel::B1,
                Semester::Q2, Semester::Q3  => GeRLevel::B1_B2,
                Semester::Q4                => $isEnglish ? GeRLevel::B2_C1 : GeRLevel::B2,
            },
            LanguageType::Initial_FS => match ($trajectory->getSemester()) {
                Semester::VK                => GeRLevel::NONE,
                Semester::EP, Semester::Q1  => GeRLevel::A2,
                Semester::Q2, Semester::Q3  => GeRLevel::B1,
                Semester::Q4                => $isEnglish ? GeRLevel::B2_C1 : GeRLevel::B2,
            }
        };
    }

}
