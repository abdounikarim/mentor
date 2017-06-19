<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/06/2017
 * Time: 13:50
 */

namespace MentorBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GeneratorController extends Controller
{
    /**
     * @Route("/generator", name="generator")
     */
    public function generatorAction()
    {
        $today = new \DateTime();

        $form = $this->createFormBuilder()->add(
            'date', DateType::class, array(
                'data' => $today
            )
        )->getForm();

        return $this->render('default/generator.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("ajax-generator/{month}/{year}", name="ajax_generator")
     */
    public function ajaxGeneratorAction(Request $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');

        $result = $this->getDoctrine()->getManager()->getRepository('MentorBundle:Session')->countByMonth($month, $year);

        $billingData = $this->get('mentor.total_amount_calculator')->calculate($result);

        $response = new JsonResponse();
        return $response->setData($billingData);
    }
}
