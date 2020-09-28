<?php


namespace App\Controller;

use App\Entity\Activity;
use App\Entity\InfoCoach;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Timeline;

class CoachingController extends AbstractController
{
    /**
     * @Route("/coaching", name="app_coaching")
     */
    public function index() : Response
    {
        $coachInfo = $this->getDoctrine()
            ->getRepository(InfoCoach::class)
            ->findOneBy([]);

        $activities = $this->getDoctrine()
            ->getRepository(Activity::class)
            ->findBy(['category'=>'coaching']);

        return $this->render('coaching/index.html.twig', [
            'etapes' => Timeline::COACHING,
            'coachInfo' => $coachInfo,
            'activities' => $activities,
            'title' => 'Coaching',
            'underTitle' => 'Mes différents accompagnements',
        ]);
    }
}
