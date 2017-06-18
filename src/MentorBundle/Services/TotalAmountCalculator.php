<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/06/2017
 * Time: 12:53
 */

namespace MentorBundle\Services;


class TotalAmountCalculator
{
    public function calculate($data)
    {
        $billingData = [
            'type' => [],
            'amount' => 0
        ];

        foreach ($data as $row) {
            $price = $row['noshow'] === true ? $row['price'] / 2 : $row['price'];

            $billingData['type'][] = [
                'noshow' => $row['noshow'],
                'level' => $row['name'],
                'price' => $price,
                'total' => $row[1]
            ];

            $billingData['amount'] += $price * $row[1];
        }

        return $billingData;
    }
}
