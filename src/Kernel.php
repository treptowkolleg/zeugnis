<?php
/*
 * Copyright (c) 2025 - Benjamin Wagner.
 * MIT License: https://opensource.org/licenses/MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the “Software”), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

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