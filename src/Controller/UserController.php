<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_inscription", methods={"GET","POST"})
     */
    public function inscription(
        Request $request, 
        ValidatorInterface $validator,
        TranslatorInterface $translator,
        EntityManagerInterface $manager
    ): Response {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        if ( $request->isMethod("POST") ) {
            $form->handleRequest($request);

            if ( $form->isSubmitted() && $form->isValid() ) {
                $manager->persist($user);
                $manager->flush();
            } else {
                $errors = $validator->validate($form);
                 
                foreach ( $errors as $error ) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
        }

        return $this->render('user/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="security_login", methods={"GET","POST"})
     */
    public function login(
        Request $request, 
        ValidatorInterface $validator,
        UserRepository $repository
    ): Response {

        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('security_login')
        ]);
        
        if ( $request->isMethod("POST") ) {
            $form->handleRequest($request);

            if ( $form->isSubmitted() && $form->isValid() ) {
                $user = $repository->findOneByLogin($user->getLogin());
                
                if (null !== $user && $user->getPassword() === $form->getData()->getPassword()) {
                    $this->addFlash('success', 'Identifiants valides.');
                } else {
                    $this->addFlash('success', 'Identifiants invalides.');
                }
            } else {
                $errors = $validator->validate($form);
             
                foreach ( $errors as $error ) {
                    $this->addFlash('error', $error->getMessage()." ");
                }
            }
        }

        return $this->render('user/login.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/all", name="security_all", methods={"GET","POST"})
     */
    public function all(
        UserRepository $repository
    ): Response {

        $users = $repository->findAll();

        return $this->render('user/all.html.twig', [
            'users' => $users
        ]);
    }
}