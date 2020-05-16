<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage homepage.
 *
 * @Route("/")
 *
 */
class DefaultController extends AbstractController
{
	/**
     * @Route("/")
     */
    public function index()
    {
       return $this->render('default/homepage.html.twig');
    }   

}
