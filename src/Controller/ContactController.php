<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\InfoCoach;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact/", name="app_contact")
     * @return Response
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        $coachInfo = $this->getDoctrine()
            ->getRepository(InfoCoach::class)
            ->findOneBy([]);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($_POST['captcha'] == $_SESSION['captcha'] + 1) {
                $email = (new Email())
                    ->from($contact->getEmail())
                    ->to('peter.dionisiopro@gmail.com')
                    ->subject('coach-peter.com : un nouveau message du formulaire de contact')
                    ->html($this->renderView('contact/mail.html.twig', [
                        'contact' => $contact,
                    ]));

                $mailer->send($email);
                $this->addFlash('success', 'Votre message a bien été envoyé. Le Coach Peter reviendra vers vous
            d\'ici peu');
                return $this->redirectToRoute('app_index');
            } else {
                $this->addFlash('danger', 'Merci de vérifier la saisie du STOP ROBOT, SVP.');
            }
        }

        $_SESSION['captcha'] = mt_rand(1000, 9999);
        return $this->render('contact/contact.html.twig', [
            'coachInfo' => $coachInfo,
            'form' => $form->createView(),
            'title' => 'Contact',
            'underTitle' => 'Rencontrons-nous',
            'captcha' => $_SESSION['captcha']
        ]);
    }
}
