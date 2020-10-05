<?php


namespace App\Controller;

use App\Entity\InfoCoach;
use App\Entity\Program;
use App\Entity\Attended;
use App\Entity\Activity;
use App\Entity\User;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Timeline;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use \DateInterval;

class OnlineController extends AbstractController
{
    /**
     * @Route("/online", name="app_online")
     */
    public function index() : Response
    {
        $coachInfo = $this->getDoctrine()
            ->getRepository(InfoCoach::class)
            ->findOneBy([]);

        $activities = $this->getDoctrine()
            ->getRepository(Activity::class)
            ->findBy(['category'=>'distance']);

        return $this->render('online/index.html.twig', [
            'activities' => $activities,
            'etapes' => Timeline::ONLINE,
            'coachInfo' => $coachInfo,
            'title' => 'Programmes en ligne',
            'underTitle' => 'Retrouvez la forme, en toute autonomie',
        ]);
    }

    /**
     * @Route("/online/choix", name="app_online_choice")
     */
    public function choice() : Response
    {
        $coachInfo = $this->getDoctrine()
            ->getRepository(InfoCoach::class)
            ->findOneBy([]);

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['online'=>true]);

        return $this->render('online/choice_programme.html.twig', [
            'etapes' => Timeline::ONLINE,
            'coachInfo' => $coachInfo,
            'programs' => $programs,
            'title' => 'Programmes en ligne',
            'underTitle' => 'Retrouvez la forme, en toute autonomie',
        ]);
    }

    /**
     * @Route("/online/suscrib", name="app_online_suscrib", methods={"POST"})
     */
    public function suscrib(Request $request) : Response
    {
        $user = $this->getUser();
        $attended = new Attended();

        /** @var Program $program */
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id'=>$_POST['select_program']]);

        $duration = $program->getDuration();

        $begin = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P'.$duration.'D'));
        $attended->setBeginDate($begin);
        $attended->setEndDate($end);
        $attended->setProgram($program);
        $attended->setUser($user);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($attended);
        $entityManager->flush();
        $this->addFlash('success', 'Votre adhésion est bien validée. Vous pouvez accéder à vos ressource
        dans votre espace Membre (accessible par votre profil) !');

        return $this->redirectToRoute('app_member');

//        $this->addFlash('danger', 'Une erreur s\'est poduite, merci de réessayer ultérieurement ou de nous envoyer un
//          message via la page contact. Merci de votre compréhension.');
//        return $this->redirectToRoute('app_member');
    }
}
