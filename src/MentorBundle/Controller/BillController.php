<?php

namespace MentorBundle\Controller;

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
        return $this->render('default/bill.html.twig', [
            'paths' => $paths
        ]);
    }

    /**
     * @Route("/ajax/project/{project_id}", name="ajax_project")
     */
    public function ajaxProjectAction($project_id){
        $em = $this->getDoctrine()->getManager();
        $paths = $em->getRepository('MentorBundle:Project')->findBy(['path' => $project_id]);
        $data = [];
        foreach ($paths as $path) {
            $data[] = [
                'id' => $path->getId(),
                'name' => $path->getName()
            ];
        }
        $response = new JsonResponse();
        return $response->setData([
            'data' => $data,
        ]);

    }

}
