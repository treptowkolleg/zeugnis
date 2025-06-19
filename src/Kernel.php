<?php

namespace App;

use App\Domain\Course\Enum\Semester;
use App\Domain\GeR\Enum\GeRLevel;
use App\Domain\GeR\Resolver\GeRLevelResolver;
use App\Domain\Language\Enum\Language;
use App\Domain\Language\Enum\LanguageType;
use App\Domain\Language\Model\LanguageTrajectory;
use App\Entity\Student;

class Kernel
{

    public function __construct()
    {
        // Person erstellen
        $ben = new Student('Benjamin Wagner');

        // Sprachverläufe hinzufügen
        $ben->addLanguageTrajectory(new LanguageTrajectory(Language::English, LanguageType::Primary_FS, Semester::Q4));
        $ben->addLanguageTrajectory(new LanguageTrajectory(Language::Spanish, LanguageType::Secondary_FS, Semester::Q1));

        // Annahme: Ende Vorkurs nicht ausreichend für GeR-Einstufung
        $ben->addLanguageTrajectory(new LanguageTrajectory(Language::French, LanguageType::Secondary_FS, Semester::VK));

        // Annahme: Latein wird laut VO-KA anders klassifiziert (kleines/großes Latinum)
        $ben->addLanguageTrajectory(new LanguageTrajectory(Language::Latin, LanguageType::Initial_FS, Semester::Q4));

        $languageLevelResolver = new GeRLevelResolver();

        // Alle GeR-eingestuften Sprachkenntnisse ausgeben
        foreach ($ben->getLanguageTrajectories() as $languageTrajectory) {
            $level = $languageLevelResolver->resolve($languageTrajectory);
            if($level != GeRLevel::NONE) {
                echo sprintf(
                    "Dein GeR-Niveau für %s als %s mit Ende %s liegt bei %s.\n",
                    $languageTrajectory->getLanguage()->value,
                    $languageTrajectory->getType()->value,
                    $languageTrajectory->getSemester()->value,
                    $level->value
                );
            }
        }

    }

}