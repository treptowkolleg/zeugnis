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

namespace App\Domain\Student\Model;

use App\Domain\Course\Model\Course;
use App\Domain\Language\Model\LanguageTrajectory;
use App\System\Util\ArrayCollection;

class Student
{
    private ?int $student_id = null;
    private ?string $first_name;
    private ?string $last_name;
    private ArrayCollection $courses;
    private ArrayCollection $languageTrajectories;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->languageTrajectories = new ArrayCollection();
    }

    public function getStudentId(): ?int
    {
        return $this->student_id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(?string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getCourses(): ArrayCollection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): void
    {
        $this->courses->add($course);
    }

    public function removeCourse(Course $course): void
    {
        $this->courses->remove($course);
    }

    /**
     * @return ArrayCollection<LanguageTrajectory>
     */
    public function getLanguageTrajectories(): ArrayCollection
    {
        return $this->languageTrajectories;
    }

    public function addLanguageTrajectory(LanguageTrajectory $languageTrajectory): void
    {
        $this->languageTrajectories->add($languageTrajectory);
    }

}