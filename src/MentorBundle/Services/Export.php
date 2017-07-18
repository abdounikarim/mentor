<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 18/07/2017
 * Time: 11:01
 */

namespace MentorBundle\Services;


use MentorBundle\Entity\User;
use MentorBundle\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class Export
{
    const CREATOR = 'Mentor Project';

    protected $sessionRepository;
    protected $author;
    protected $title;
    protected $subject;
    protected $month;
    protected $year;

    public function __construct(SessionRepository $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    protected function setDocInfos(User $mentor, $period)
    {
        $this->year = $period['year'];
        $this->month = $period['month'];
        $this->author = $mentor->getFullname();
        $this->title = 'sessions-'. $this->month . $this->year;
        $this->subject = 'Sessions de ' . $this->author . ' pour la période ' . $this->month . '/' . $this->year;
    }

    public function prepareResponse($type, $filename)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/'.$type);
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename .'"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }
}
