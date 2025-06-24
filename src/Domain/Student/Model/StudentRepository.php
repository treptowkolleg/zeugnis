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

use App\Domain\Language\Model\LanguageTrajectoryRepository;
use App\System\Model\MySQLConnector;

class StudentRepository
{

    /**
     * @param Student $student
     * @return int last inserted id or 0 on failure
     */
    public static function create(Student $student): int
    {
        $connection = new MySQLConnector();

        $statement = $connection->prepare("INSERT INTO student (first_name, last_name) VALUES (:first_name, :last_name)");
        $statement->bindValue(':first_name', $student->getFirstName());
        $statement->bindValue(':last_name', $student->getLastName());

        return $statement->execute() ? $connection->lastInsertId() : false;
    }

    /**
     * @param int $id
     * @return false|Student
     */
    public static function find(int $id): false|Student
    {
        $connection = new MySQLConnector();
        $statement = $connection->prepare("SELECT * FROM student WHERE student_id = :id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        $student = $statement->fetchObject(Student::class);
        self::addLanguageTrajectories($student);
        return $student;
    }

    /**
     * @param string $lastName
     * @return false|Student
     */
    public static function findOneByLastname(string $lastName): false|Student
    {
        $connection = new MySQLConnector();
        $statement = $connection->prepare("SELECT * FROM student WHERE last_name LIKE :last_name LIMIT 1");
        $statement->bindValue(':last_name', "%$lastName%");
        $statement->execute();
        $student = $statement->fetchObject(Student::class);
        self::addLanguageTrajectories($student);
        return $student;
    }

    /**
     * @param false|Student $student
     * @return void
     */
    public static function addLanguageTrajectories(false|Student $student): void
    {
        if ($student) {
            $trajectories = LanguageTrajectoryRepository::findByStudentId($student->getStudentId());
            foreach ($trajectories as $trajectory) {
                $student->addLanguageTrajectory($trajectory);
            }
        }

    }

}