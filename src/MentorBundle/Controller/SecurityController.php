<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 04/06/2017
 * Time: 11:42
 */

namespace MentorBundle\Controller;


use MentorBundle\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Method({"GET', "POST"})
     *
     * @return Response
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginType::class, [
            '_username' => $lastUsername
        ]);

        return $this->render('security/login.html.twig', array(
            'form' => $form->createView(),
            'error' => $error
        ));
    }

    /**
     * @Route("/logout", name="logout")
     * @Method("GET")
     *
     * @throws \Exception
     */
    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }
}
