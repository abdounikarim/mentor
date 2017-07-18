<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 11/07/2017
 * Time: 22:39
 */

namespace MentorBundle\Services;


use MentorBundle\Entity\User;
use MentorBundle\Repository\SessionRepository;

class ExportExcel extends Export
{
    use ExcelStyles;

    private $excelObj;

    public function __construct(SessionRepository $sessionRepository)
    {
        parent::__construct($sessionRepository);
        $this->excelObj = new \PHPExcel();
    }

    public function exportToXLS(User $author, $period)
    {
        $this->setDocInfos($author, $period);

        $this->excelObj->getProperties()
            ->setCreator(self::CREATOR)
            ->setLastModifiedBy($this->author)
            ->setTitle($this->title)
            ->setSubject($this->subject);

        $this->defineSheetsTitles(['Sessions', 'Facture']);

        // Sessions sheet
        $this->writeSessionsSheet($author);

        // Bill sheet
        $this->writeBillSheet($this->month, $this->year, $author);

        $this->autosizeColumnsWidth();

        $this->excelObj->setActiveSheetIndex(0);

        return \PHPExcel_IOFactory::createWriter($this->excelObj, 'Excel5');
    }

    private function writeSessionsSheet($author)
    {
        $sessionsData = $this->sessionRepository->findAllByUser($author);

        $sessionsSheet = $this->excelObj->setActiveSheetIndexByName('Sessions');
        $sessionsSheet
            ->setCellValue('A1', 'Date')
            ->setCellValue('B1', 'Mentoré')
            ->setCellValue('C1', 'Parcours')
            ->setCellValue('D1', 'Projet')
            ->setCellValue('E1', 'Type')
            ->setCellValue('F1', 'No-show')
            ->setCellValue('G1', 'Tarif');

        $dataLength = count($sessionsData);
        for ($i = 0; $i < $dataLength; $i++) {
            $sessionsSheet
                ->setCellValue('A' . ($i + 2), date_format($sessionsData[$i]->getDate(), 'd/m/Y'))
                ->setCellValue('B' . ($i + 2), $sessionsData[$i]->getStudent()->getFirstname() . ' ' . $sessionsData[$i]->getStudent()->getLastname())
                ->setCellValue('C' . ($i + 2), $sessionsData[$i]->getStudent()->getPath()->getName())
                ->setCellValue('D' . ($i + 2), $sessionsData[$i]->getProject()->getName())
                ->setCellValue('E' . ($i + 2), $sessionsData[$i]->getType())
                ->setCellValue('F' . ($i + 2), $sessionsData[$i]->isNoshow() ? 'Oui' : '')
                ->setCellValue('G' . ($i + 2), $sessionsData[$i]->getPrice());
        }

        $sessionsSheet->duplicateStyle($this->applyTitleStyle(), 'A1:G1');

        $lastRow = $this->excelObj->getActiveSheet()->getHighestRow();

        $this->applyCurracyStyle('G2:G' . $lastRow);

        return $this->excelObj;
    }

    private function writeBillSheet($month, $year, $author)
    {
        $billData = $this->sessionRepository->getByMonth($month, $year, $author);

        $billSheet = $this->excelObj->setActiveSheetIndexByName('Facture');
        $billSheet
            ->setCellValue('A1', 'Désignation')
            ->setCellValue('B1', 'Quantité')
            ->setCellValue('C1', 'P.U. HT')
            ->setCellValue('D1', 'Unité')
            ->setCellValue('E1', 'Total HT');

        $billDataLength = count($billData);
        for ($i = 0; $i < $billDataLength; $i++) {
            $noshow = $billData[$i]['noshow'] ? 'No-show - ' : '';
            $total = $billData[$i]['noshow'] ? ($billData[$i]['price']/2) * $billData[$i][1] : $billData[$i]['price'] * $billData[$i][1];

            $billSheet
                ->setCellValue('A' . ($i + 2), $noshow . 'Session niveau ' . $billData[$i]['name'])
                ->setCellValue('B' . ($i + 2), $billData[$i][1])
                ->setCellValue('C' . ($i + 2), $billData[$i]['noshow'] ? $billData[$i]['price']/2 : $billData[$i]['price'])
                ->setCellValue('D' . ($i + 2), 'Session')
                ->setCellValue('E' . ($i + 2), $total);
        }

        $lastRow = $this->excelObj->getActiveSheet()->getHighestRow();
        $firstEmptyRow = $lastRow + 1;

        $billSheet
            ->setCellValue('D' . $firstEmptyRow, 'Total HT')
            ->setCellValue('E' . $firstEmptyRow, '=SUM(E1:E' . $lastRow . ')');

        $billSheet->duplicateStyle($this->applyTitleStyle(), 'A1:E1');
        $billSheet->duplicateStyle($this->applyTitleStyle(), 'D'. $firstEmptyRow . ':E' . $firstEmptyRow);
        $this->applyCurracyStyle('C2:C' . $lastRow);
        $this->applyCurracyStyle('E2:E' . $firstEmptyRow);

        return $this->excelObj;
    }
}
