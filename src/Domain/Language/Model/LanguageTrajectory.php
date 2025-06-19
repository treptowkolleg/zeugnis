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