<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/07/2017
 * Time: 22:23
 */

namespace MentorBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AjaxBillController
 * @package MentorBundle\Controller
 *
 * @Route("/ajax")
 */
class AjaxBillController extends Controller
{
    /**
     * @Route("/students", name="ajax_students")
     */
    public function ajaxStudentsAction(Request $request)
    {
        $students = $this->get('mentor.student_repository')->findStudentsByTerm($request);

        $response = new JsonResponse();
        return $response->setData($students);
    }

    /**
     * @Route("/project/{project_id}", name="ajax_project")
     */
    public function ajaxProjectAction($project_id){
        $data = $this->get('mentor.project_repository')->findByPath(['path' => $project_id]);

        $response = new JsonResponse();
        return $response->setData([
            'data' => $data,
        ]);

    }

    /**
     * @Route("/bill-generator/{month}/{year}", name="ajax_bill_generator")
     */
    public function ajaxBillGeneratorAction(Request $request)
    {
        $billingData = $this->get('mentor.total_amount_calculator')->calculate($request);

        $response = new JsonResponse();
        return $response->setData($billingData);
    }

}
