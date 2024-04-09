<?php

namespace App\Tests;

use App\Entity\Training;
use PHPUnit\Framework\TestCase;

class TrainingEntityTest extends TestCase
{
    public function testTrainingEntity(): void
    {
        $training = new Training();
        $score = 10;
        $createdAt = new \DateTimeImmutable();

        $training->setScore($score);
        $training->setCreatedAt($createdAt);

        $this->assertEquals($score, $training->getScore());
        $this->assertEquals($createdAt, $training->getCreatedAt());

        $this->assertNull($training->getId());
    }
}
