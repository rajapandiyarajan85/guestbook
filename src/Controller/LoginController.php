<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
	private $usersList;
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
		if ($this->getUser()) {
		 return $this->redirectToRoute('book_show');
		}
		
		// To get users from DB use the below code
		/* 
		$repository = $this->getDoctrine()->getRepository(User::class);	
		$this->usersList = $repository->findAll();		
		*/		
		
		// Refer UserFixtures for dummy user data
		$this->usersList = [            
            ['userName'=>'Raja Admin', 'userPassword'=>'Test@123', 'userEmail'=>'admin@yahoo.com', 'role' => 'Admin'],            
            ['userName'=>'Raja User', 'userPassword'=>'Test@123', 'userEmail'=>'user@yahoo.com', 'role' => 'User'],
        ];
		
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();		

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'usersList' => $this->usersList]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
