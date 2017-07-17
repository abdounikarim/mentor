<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 06/07/2017
 * Time: 17:48
 */

namespace MentorBundle\Controller;


use MentorBundle\Form\Type\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/register", name="register")
     *
     * @param Request $request
     * @return null|\Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Bienvenue '. $user->getFirstname() . ' ' . $user->getLastname());

            // Automatically login after registration
            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('mentor.security.form_authenticator'),
                    'main'
                );
        }

        return $this->render('user/register.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
