<?php

namespace MentorBundle\Controller;

use MentorBundle\Entity\Session;
use MentorBundle\Form\Type\SessionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BillController extends Controller
{
    /**
     * @Route("/bill", name="bill")
     */
    public function billAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paths = $em->getRepository('MentorBundle:Path')->findAll();
        $sessions = $em->getRepository('MentorBundle:Session')->findAll();

        $session = new Session();
        $form = $this->get('form.factory')->create(SessionType::class, $session);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // TODO Demande de confirmation
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();

            $this->addFlash('success', 'Session ajoutée');
            return $this->redirectToRoute('bill');

        }

        return $this->render('default/bill.html.twig', [
            'paths' => $paths,
            'sessions' => $sessions,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ajax/students", name="ajax_students")
     */
    public function ajaxStudentsAction(Request $request)
    {
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('MentorBundle:Student')->findStudentsByTerm($term);

        $response = new JsonResponse();
        return $response->setData($students);
    }

    /**
     * @Route("/ajax/project/{project_id}", name="ajax_project")
     */
    public function ajaxProjectAction($project_id){
        $em = $this->getDoctrine()->getManager();
        $projects = $em->getRepository('MentorBundle:Project')->findBy(['path' => $project_id]);
        $data = [];
        foreach ($projects as $project) {
            $data[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'price' => $project->getPrice()->getPrice()
            ];
        }
        $response = new JsonResponse();
        return $response->setData([
            'data' => $data,
        ]);

    }
}
