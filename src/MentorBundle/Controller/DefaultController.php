<?php

namespace MentorBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/generator", name="generator")
     */
    public function generatorAction()
    {
        $result = $this->getDoctrine()->getManager()->getRepository('MentorBundle:Session')->countByMonth(06);

        $billingData = $this->get('mentor.total_amount_calculator')->calculate($result);

        return $this->render('default/generator.html.twig', array(
            'billingData' => $billingData
        ));
    }

    /**
     * @Route("/job", name="job")
     */
    public function jobAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }
}
