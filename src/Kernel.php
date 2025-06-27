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

use App\Domain\GeR\Enum\GeRLevel;
use App\Domain\GeR\Resolver\GeRLevelResolver;
use App\Domain\Language\Model\LanguageTrajectory;
use App\Domain\Student\Model\StudentRepository;

class Kernel
{

    public function __construct()
    {
        // Person abrufen
        $student = StudentRepository::findOneByLastname("wagner");

        $languageLevelResolver = new GeRLevelResolver();

        if (!$student) exit("Student not found.");

        echo sprintf("Es gibt %d Sprachverläufe.\n", $student->getLanguageTrajectories()->count());

        // Alle GeR-eingestuften Sprachkenntnisse ausgeben
        foreach ($student->getLanguageTrajectories() as $languageTrajectory) {

            /** @var LanguageTrajectory $languageTrajectory */
            $level = $languageLevelResolver->resolve($languageTrajectory);

            if($level == GeRLevel::NONE) continue;

            echo sprintf(
                "Dein GeR-Niveau für %s als %s mit Ende %s liegt bei %'.5s.\n",
                $languageTrajectory->getLanguage()->getValue(),
                $languageTrajectory->getType()->getValue(),
                $languageTrajectory->getLastSemester()->getValue(),
                $level->getValue()
            );

        }

    }

}