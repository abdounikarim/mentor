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
    public function generatorAction(Request $request)
    {
        $sessions = $this->getDoctrine()->getManager()->getRepository('MentorBundle:Session')->findByMonth('06');

        dump($sessions);
        return $this->render('default/generator.html.twig');
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
