<?php

namespace App\Entity;

use App\Domain\Language\Model\LanguageTrajectory;
use App\System\Util\ArrayCollection;

class Student
{
    private ?int $id = null;
    private ?string $name;
    private ArrayCollection $courses;
    private ArrayCollection $languageTrajectories;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->courses = new ArrayCollection();
        $this->languageTrajectories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
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