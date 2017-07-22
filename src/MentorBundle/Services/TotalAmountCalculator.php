<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/06/2017
 * Time: 12:53
 */

namespace MentorBundle\Services;

use MentorBundle\Repository\SessionRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class TotalAmountCalculator
{
    private $sessionRepository;
    private $mentor;

    public function __construct(SessionRepository $sessionRepository, TokenStorage $tokenStorage)
    {
        $this->sessionRepository = $sessionRepository;
        $this->mentor = $tokenStorage->getToken()->getUser();
    }

    /**
     * @param $request
     * @return array
     */
    public function calculate($month, $year)
    {
        $data = $this->sessionRepository->getBillDataByUserAndPeriod($month, $year, $this->mentor);

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
