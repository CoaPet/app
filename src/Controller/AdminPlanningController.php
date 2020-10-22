<?php

namespace App\Controller;

use App\Entity\Planning;
use App\Form\PlanningType;
use App\Repository\PlanningRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/planning")
 */
class AdminPlanningController extends AbstractController
{
    /**
     * @Route("/", name="planning_index", methods={"GET"})
     */
    public function index(PlanningRepository $planningRepository): Response
    {
        $dataPlanning = new Planning();

        $allLessons = $planningRepository->findBy([], ['hour' => 'ASC']);
        $cours = [];
        foreach ($allLessons as $lesson) {
            $cours[$lesson->getDay()][$lesson->getHour()] = $lesson;
        }

        return $this->render('admin_planning/index.html.twig', [
            'visualPlanning' => $planningRepository->findAll(),
            'hours' => $dataPlanning::HOURS,
            'days' => $dataPlanning::DAYS,
            'cours'=> $cours,
        ]);
    }

    /**
     * @Route("/new", name="planning_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
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

        $planning = new Planning();
        $form = $this->createForm(PlanningType::class, $planning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planning);
            $entityManager->flush();

            return $this->redirectToRoute('planning_index');
        }

        return $this->render('admin_planning/new.html.twig', [
            'planning' => $planning,
            'form' => $form->createView(),
            'visualPlanning' => $visualPlanning,
            'hours' => $dataPlanning::HOURS,
            'days' => $dataPlanning::DAYS,
            'cours'=> $cours,
        ]);
    }

    /**
     * @Route("/{id}", name="planning_show", methods={"GET"})
     */
    public function show(Planning $planning): Response
    {
        return $this->render('admin_planning/show.html.twig', [
            'planning' => $planning,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planning_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Planning $planning): Response
    {
        $form = $this->createForm(PlanningType::class, $planning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planning_index');
        }

        return $this->render('admin_planning/edit.html.twig', [
            'planning' => $planning,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Planning $planning): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planning->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planning);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_index');
    }
}
