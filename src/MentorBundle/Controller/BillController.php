<?php

namespace MentorBundle\Controller;

use MentorBundle\Entity\Session;
use MentorBundle\Entity\Student;
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
        $session = new Session();
        $form = $this->get('form.factory')->create(SessionType::class, $session);

        $em = $this->getDoctrine()->getManager();
        $paths = $em->getRepository('MentorBundle:Path')->findAll();
        $sessions = $em->getRepository('MentorBundle:Session')->findAll();

        return $this->render('default/bill.html.twig', [
            'paths' => $paths,
            'sessions' => $sessions,
            'form' => $form->createView()
        ]);
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

    /**
     * @Route("/ajax/student/{name}", name="ajax_student")
     */
    public function ajaxStudentAction(Student $student)
    {
        $data = [
            'path' => $student->getPath()->getId()
        ];

        $response = new JsonResponse();
        return $response->setData(array(
            'data' => $data
        ));
    }
}
