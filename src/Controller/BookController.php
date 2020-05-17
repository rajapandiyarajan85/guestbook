<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BookController extends AbstractController
{
    /**
     * @Route("/book/create", name="book_create")
     */
    public function create(Request $request)
    {
		$book = new Book();
		$user = $this->getUser();		
		$book->setUserId($user->getId());
        $book->setDateCreated(new \DateTime());
		$book->setStatus(0);
		
        $form = $this->createForm(BookType::class, $book);
		
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			// $form->getData() holds the submitted values			
			$book = $form->getData();					
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($book);
			$entityManager->flush();			
			$this->addFlash('success', 'Guest Book Created Successfully! To see your updates kindly wait for Admin approval!');
			return $this->redirectToRoute('book_show');
		}

        return $this->render('book/create.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
	
	/**
     * @Route("/book/show", name="book_show")
     */
    public function show()
    {
		$repository = $this->getDoctrine()->getRepository(Book::class);	
		$bookList = $repository->findAll(1);	
		
        return $this->render('book/show.html.twig', [
            'bookList' => $bookList,
        ]);
    }
	
	
}
