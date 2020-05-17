<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index()
    {
		$guestBookList = [
            
        ];

        return $this->render('admin/default/homepage.html.twig', [
            'bookList' => $guestBookList,
        ]);
    }
}
