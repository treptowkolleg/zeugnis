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
        if ($trajectory->getLanguage() == Language::Latin) return GeRLevel::NONE;

        $isEnglish = $trajectory->getLanguage() == Language::English;

        return match ($trajectory->getType()) {
            LanguageType::Primary_FL => match ($trajectory->getLastSemester()) {
                Semester::VK                => GeRLevel::NONE,
                Semester::EP, Semester::Q1  => GeRLevel::B1,
                Semester::Q2, Semester::Q3  => GeRLevel::B2,
                Semester::Q4                => $isEnglish ? GeRLevel::B2_C1 : GeRLevel::B2,
            },
            LanguageType::Secondary_FL => match ($trajectory->getLastSemester()) {
                Semester::VK                => GeRLevel::NONE,
                Semester::EP, Semester::Q1  => GeRLevel::B1,
                Semester::Q2, Semester::Q3  => GeRLevel::B1_B2,
                Semester::Q4                => $isEnglish ? GeRLevel::B2_C1 : GeRLevel::B2,
            },
            LanguageType::Initial_FL => match ($trajectory->getLastSemester()) {
                Semester::VK                => GeRLevel::NONE,
                Semester::EP, Semester::Q1  => GeRLevel::A2,
                Semester::Q2, Semester::Q3  => GeRLevel::B1,
                Semester::Q4                => $isEnglish ? GeRLevel::B2_C1 : GeRLevel::B2,
            }
        };
    }

}
