<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 17/07/2017
 * Time: 15:54
 */

namespace MentorBundle\Services;


trait Excel
{
    private function defineSheetsTitles(array $titles)
    {
        $sheet = 0;
        foreach($titles as $value){
            if($sheet > 0){
                $this->excelObj->createSheet();
                $sheet = $this->excelObj->setActiveSheetIndex($sheet);
                $sheet->setTitle("$value");
            }else{
                $this->excelObj->setActiveSheetIndex(0)->setTitle("$value");
            }
            $sheet++;
        }

    }
    private function applyTitleStyle()
    {
        $titleStyle = new \PHPExcel_Style();
        $titleStyle->applyFromArray(
            [
                'font' => [
                    'bold' => true,
                    'name' => 'Arial',
                    'size' => 11
                ],
                'alignment' => [
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER
                ]
            ]
        );

        return $titleStyle;
    }

    private function applyCurracyStyle($range)
    {
        $this->excelObj->getActiveSheet()->getStyle($range)
            ->getNumberFormat()->setFormatCode('#,##0.00 €');
    }

    private function autosizeColumnsWidth()
    {
        foreach ($this->excelObj->getWorksheetIterator() as $worksheet) {

            $this->excelObj->setActiveSheetIndex($this->excelObj->getIndex($worksheet));

            $sheet = $this->excelObj->getActiveSheet();
            $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            foreach ($cellIterator as $cell) {
                $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
            }
        }
        return $this->excelObj;
    }

}
