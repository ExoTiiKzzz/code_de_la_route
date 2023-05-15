<?php

namespace App;

use App\Entity\Training;
use App\Entity\TrainingType;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;

class DashboardService
{
    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }

    public function getDashboardStatistics(): array
    {
        $statistics = [];
        $totalTrainings = 0;
        $totalTrainingsScore = 0;
        $labels = [];
        $trainingTypes = $this->em->getRepository(TrainingType::class)->findAll();
        $lastSession = $this->em->getRepository(Training::class)->findOneBy([], ['id' => 'DESC']);

        foreach ($trainingTypes as $trainingType) {
            $trainings = $trainingType->getTrainings();
            $statistics['type'][$trainingType->getName()]['total'] = count($trainings);
            $totalTrainings += count($trainings);
            $trainingTypeScoreTotal = 0;
            /** @var Training $training */
            foreach ($trainings as $training) {
                $labels[] = $training->getCreatedAt()->format('Y-m-d H:i');
                $totalTrainingsScore += $training->getScore();
                $trainingTypeScoreTotal += $training->getScore();
                $std = new StdClass();
                $std->id = $training->getId();
                $std->score = $training->getScore();
                $std->date = $training->getCreatedAt()->format('Y-m-d H:i:s');
                $statistics['trainings'][] = $std;
            }
            $statistics['type'][$trainingType->getName()]['average'] = round($trainingTypeScoreTotal / count($trainings), 2);
            $statistics['type'][$trainingType->getName()]['color'] = $trainingType->getColor();
        }

        //order labels
        usort($labels, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });

        $statistics['labels'] = $labels;
        $statistics['average'] = round($totalTrainingsScore / $totalTrainings, 2);
        $statistics['total'] = $totalTrainings;
        $statistics['lastSession'] = $lastSession;

        return $statistics;
    }
}