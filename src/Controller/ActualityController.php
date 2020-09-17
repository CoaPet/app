<?php

namespace App\Controller;

use App\Entity\InfoCoach;
use App\Repository\ActualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actualite", name="app_actuality")
     */
    public function index(
        ActualityRepository $actualityRepository,
        request $request,
        PaginatorInterface $paginator
    ): Response {
        $articles = $actualityRepository->findBy([], ['date' => 'DESC']);
        $pageArticles = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            5
        );
        $coachInfo = $this->getDoctrine()
            ->getRepository(InfoCoach::class)
            ->findOneBy([]);

        return $this->render('actuality/index.html.twig', [
            'coachInfo' => $coachInfo,
            'actualities' => $pageArticles,
            'title' => 'Actualités',
            'underTitle' => 'Suivez mes conseils, au jour le jour',
        ]);
    }
}
