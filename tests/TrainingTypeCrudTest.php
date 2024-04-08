<?php

namespace App\Tests;

use App\Controller\Admin\DashboardController;
use App\Controller\Admin\TrainingTypeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Test\AbstractCrudTestCase;

class TrainingTypeCrudTest extends AbstractCrudTestCase
{
    protected function getControllerFqcn(): string
    {
        return TrainingTypeCrudController::class;
    }

    protected function getDashboardFqcn(): string
    {
        return DashboardController::class;
    }

    public function testIndex(): void
    {
        $this->client->request('GET', $this->generateIndexUrl());
        static::assertResponseIsSuccessful();
    }


}
