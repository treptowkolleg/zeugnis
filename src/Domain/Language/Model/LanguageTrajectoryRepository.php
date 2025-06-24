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

use App\System\Model\MySQLConnector;
use PDO;

class LanguageTrajectoryRepository
{

    public static function create(LanguageTrajectory $trajectory): int
    {
        $connection = new MySQLConnector();

        $statement = $connection->prepare("INSERT INTO language_trajectory (student_id, language, type, last_semester) VALUES (:student_id, :language, :type, :last_semester)");
        $statement->bindValue(':student_id', $trajectory->getStudentId());
        $statement->bindValue(':language', $trajectory->getLanguage()->getValue());
        $statement->bindValue(':type', $trajectory->getType()->getValue());
        $statement->bindValue(':last_semester', $trajectory->getLastSemester()->getValue());

        return $statement->execute() ? $connection->lastInsertId() : false;
    }

    /**
     * @param int $studentId
     * @return array<LanguageTrajectory>
     */
    public static function findByStudentId(int $studentId): array
    {
        $connection = new MySQLConnector();
        $statement = $connection->prepare("SELECT * FROM language_trajectory WHERE student_id = :id");
        $statement->bindValue(':id', $studentId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS,LanguageTrajectory::class);
    }

}