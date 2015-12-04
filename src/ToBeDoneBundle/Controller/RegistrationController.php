<?php

namespace ToBeDoneBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use ToBeDoneBundle\Entity\User;
use ToBeDoneBundle\Form\Type\UserType;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setIsActive(true);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            try {
                $em->flush();
            } catch (UniqueConstraintViolationException $ex) {
                $this->setErrorFlashMessage($ex);
                return $this->renderRegistrationPage($form);
            }

            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            return $this->redirectToRoute('to_be_done_homepage');
        }

        return $this->renderRegistrationPage($form);
    }

    /**
     * @param Form $form
     * @return Response
     */
    private function renderRegistrationPage(Form $form)
    {
        return $this->render(
            'ToBeDoneBundle:registration:registration.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @param UniqueConstraintViolationException $ex
     */
    private function setErrorFlashMessage(UniqueConstraintViolationException $ex)
    {
        switch ($ex->getErrorCode()) {
            case 7:
                $this->addFlash('error', 'Username already exists');
                break;
            default:
                $this->addFlash('error', 'Some error occurred during writing to database');
        }
    }
}