<?php


use App\Controller\Admin\TrainingCrudController;
use App\Entity\TrainingType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use PHPUnit\Framework\TestCase;

class TrainingCrudControllerTest extends TestCase
{
    public function testConfigureFields(): void
    {
        $controller = new TrainingCrudController();
        $fields = $controller->configureFields('create');

        $this->assertCount(3, $fields);

        for ($i = 0; $i < 3; $i++) {
            #check that it implements FieldInterface
            $this->assertInstanceOf(FieldInterface::class, $fields[$i]);
        }
    }
}
