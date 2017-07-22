<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/07/2017
 * Time: 10:25
 */

namespace MentorBundle\Services;


use MentorBundle\Entity\User;
use MentorBundle\Repository\SessionRepository;
use Twig_Environment;

class ExportPDF extends Export
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    public function __construct(SessionRepository $sessionRepository, Twig_Environment $twig)
    {
        parent::__construct($sessionRepository);
        $this->twig = $twig;
    }

    public function exportToPDF(User $user, $period)
    {
        $this->setDocInfos($user, $period);

        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(self::CREATOR);
        $pdf->SetAuthor($this->author);
        $pdf->SetTitle($this->title);
        $pdf->SetSubject($this->subject);

        $pdf->setHeaderData('', null, 'Mentorat', $this->subject);
        $pdf->setFooterData();

        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

        $pdf->AddPage();

        $bill = $this->sessionRepository->getBillDataByUserAndPeriod($this->month, $this->year, $user);

        $html = $this->twig->render(
            'export/bill_export_pdf.html.twig', [
                'bill' => $bill
            ]
        );
        $pdf->writeHTML($html);
        $pdf->lastPage();

        $pdf->AddPage();

        $sessions = $this->sessionRepository->findAllByUserAndPeriod($this->month, $this->year, $user);
        $html = $this->twig->render(
            'export/sessions_export_pdf.html.twig', [
                'sessions' => $sessions
            ]
        );
        $pdf->writeHTML($html);
        $pdf->lastPage();

        return $pdf;
    }
}
