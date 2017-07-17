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
use Symfony\Component\HttpFoundation\Response;

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
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    public function ajaxStudentsAction(Request $request)
    {
        $students = $this->get('mentor.student_repository')->findStudentsByTerm($request);

        $response = new JsonResponse();
        return $response->setData($students);
    }

    /**
     * @Route("/project/{path_id}", name="ajax_project")
     *
     * @param $path_id
     * @return JsonResponse
     */
    public function ajaxProjectAction($path_id){
        $data = $this->get('mentor.project_repository')->findByPath(['path' => $path_id]);

        $response = new JsonResponse();
        return $response->setData([
            'data' => $data,
        ]);

    }

    /**
     * @Route("/bill-generator/{month}/{year}", name="ajax_bill_generator")
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \InvalidArgumentException
     */
    public function ajaxBillGeneratorAction(Request $request)
    {
        $billingData = $this->get('mentor.total_amount_calculator')
            ->calculate($request->get('month'), $request->get('year'));

        $response = new JsonResponse();
        return $response->setData($billingData);
    }

    /**
     * @Route("/export/{format}/{month}/{year}", name="ajax_export")
     * @param Request $request
     * @throws \LogicException
     * @throws \PHPExcel_Reader_Exception
     * @throws \InvalidArgumentException
     * @throws \PHPExcel_Writer_Exception
     */
    public function ajaxExportAction(Request $request)
    {
        if ($request->get('format') === 'excel') {
            $excelObj = $this->get('mentor.export_excel')->exportToXLS($this->getUser(), $request);
            $objWriter = \PHPExcel_IOFactory::createWriter($excelObj, 'Excel5');

            $response = new Response();
            $response->headers->set('Content-Type', 'application/vnd.ms-excel');
            $response->headers->set('Content-Disposition', 'attachment;filename="mentorat.xls"');
            $response->headers->set('Cache-Control', 'max-age=0');
            $response->prepare($request);
            $response->sendHeaders();
            return $objWriter->save('php://output');
        } elseif ($request->get('format') === 'pdf') {
            return;
        }
    }


}
