<?php

namespace MentorBundle\Controller;

use MentorBundle\Entity\Session;
use MentorBundle\Form\Type\SessionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 * Class BillController
 * @package MentorBundle\Controller
 *
 * @Route("/bill")
 */
class BillController extends Controller
{
    /**
     * @Route("/generator", name="bill_generator")
     */
    public function billAction()
    {
        $today = new \DateTime();

        $form = $this->createFormBuilder()->add(
            'date', DateType::class, array(
                'data' => $today
            )
        )->getForm();

        return $this->render('bill/bill.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/sessions", name="sessions")
     */
    public function sessionsAction(Request $request)
    {
        $sessionRepository = $this->get('mentor.session_repository');

        $paths = $this->get('mentor.path_repository')->findAll();
        $sessions = $sessionRepository->findAllByUser($this->getUser());

        $session = new Session();
        $form = $this->get('form.factory')->create(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->setMentor($this->getUser());
            $sessionRepository->save($session);

            $this->addFlash('success', 'Session ajoutée');
            return $this->redirectToRoute('sessions');
        }

        return $this->render('bill/sessions.html.twig', [
            'paths' => $paths,
            'sessions' => $sessions,
            'form' => $form->createView()
        ]);
    }
}
