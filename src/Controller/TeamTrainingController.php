<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Entity\InfoCoach;
use App\Entity\Planning;
use App\Entity\Degree;
use App\Entity\Activity;
use App\Repository\PlanningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Transformation;

class TeamTrainingController extends AbstractController
{
    /**
     * @Route("/team", name="index_team_traing")
     */
    public function index() : Response
    {
        $dataPlanning = new planning;

        $visualPlanning = $this->getDoctrine()
            ->getRepository(Planning::class)
            ->findAll();

        $cours = [];
        foreach ($visualPlanning as $lesson) {
            $lesson = new planning;
            $cours[$lesson->getDay()][] = $lesson;
        }


        $coachInfo = $this->getDoctrine()
            ->getRepository(InfoCoach::class)
            ->findOneBy([]);

        $activities = $this->getDoctrine()
            ->getRepository(Activity::class)
            ->findBy(['category'=>'team']);

        return $this->render('team/index.html.twig', [
            'coachInfo' => $coachInfo,
            'activities' => $activities,
            'title' => 'Team Training',
            'underTitle' => 'Ensemble on est plus fort',
            'visualPlanning' => $visualPlanning,
            'hours' => $dataPlanning::HOURS,
            'days' => $dataPlanning::DAYS,
            'test'=> $cours,
        ]);
    }
}
