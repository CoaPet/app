<?php

namespace App\Controller;

use App\Entity\InfoCoach;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Google_Client;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="app_avis")
     */
    public function index()
    {
        $coachInfo = $this->getDoctrine()
            ->getRepository(InfoCoach::class)
            ->findOneBy([]);
//        $client = new \Google_Client(['client_id'=>'peter.dionisiopro@gmail.com']);
//        $avis = new \Google_Service_MyBusiness($client);
        return $this->render('avis/index.html.twig', [
            'coachInfo' => $coachInfo,
            'title' => 'Avis',
            'underTitle' => 'Les avis de google',
        ]);
    }
}
