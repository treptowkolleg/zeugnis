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
use App\Domain\Student\Model\Student;

class LanguageTrajectory
{

    private ?int $language_trajectory_id = null;
    private ?int $student_id = null;
    private string $language;
    private string $type;
    private string $last_semester;

    public function getLanguageTrajectoryId(): ?int
    {
        return $this->language_trajectory_id;
    }

    public function getStudentId(): ?int
    {
        return $this->student_id;
    }

    public function setStudent(?Student $student): void
    {
        $this->student_id = $student->getStudentId();
    }

    public function getLanguage(): ?Language
    {
        return Language::tryFrom($this->language);
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language->getValue();
    }

    public function getType(): LanguageType
    {
        return LanguageType::tryFrom($this->type);
    }

    public function setType(LanguageType $type): void
    {
        $this->type = $type->getValue();
    }


    public function getLastSemester(): Semester
    {
        return Semester::tryFrom($this->last_semester);
    }

    public function setLastSemester(Semester $last_semester): void
    {
        $this->last_semester = $last_semester->getValue();
    }

}