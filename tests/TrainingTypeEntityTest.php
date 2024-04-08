<?php


use App\Entity\TrainingType;
use PHPUnit\Framework\TestCase;

class TrainingTypeEntityTest extends TestCase
{
    public function testTrainingTypeEntity(): void
    {
        $training = new TrainingType();
        $name = 'Examen blanc';
        $color1 = 'FF5733';
        $color2 = '#FF5733';

        $training->setName($name);
        $training->setColor($color1);

        $this->assertEquals($name, $training->getName());
        $this->assertEquals($color1, $training->getColor());

        $training->setColor($color2);
        $this->assertEquals($color1, $training->getColor());

        $this->assertNull($training->getId());
    }
}
