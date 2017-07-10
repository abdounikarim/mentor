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
        $term = trim(strip_tags($request->get('term')));

        $students = $this->get('mentor.student_manager')->findStudentsByTerm($term);

        $response = new JsonResponse();
        return $response->setData($students);
    }

    /**
     * @Route("/project/{project_id}", name="ajax_project")
     */
    public function ajaxProjectAction($project_id){
        $projects = $this->get('mentor.project_manager')->findBy(['path' => $project_id]);
        $data = [];
        foreach ($projects as $project) {
            $data[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'price' => $project->getLevel()->getPrice()->getPrice()
            ];
        }

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
        $month = $request->get('month');
        $year = $request->get('year');

        $result = $this->get('mentor.session_manager')->countByMonth($month, $year);

        $billingData = $this->get('mentor.total_amount_calculator')->calculate($result);

        $response = new JsonResponse();
        return $response->setData($billingData);
    }

}
