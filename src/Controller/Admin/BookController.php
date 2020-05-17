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
use Symfony\Component\HttpFoundation\JsonResponse;


class BookController extends AbstractController
{	
	/**
     * @Route("/admin/book/list", name="admin_book_list")
     */
    public function show()
    {
		$repository = $this->getDoctrine()->getRepository(Book::class);	
		$bookList = $repository->findAll();	
		
        return $this->render('admin/book/list.html.twig', [
            'bookList' => $bookList,
        ]);
    }
	
	/**
     * @Route("/admin/book/update", name="admin_update_list")
	 * 
     */
	public function update(Request $request) {
		
		if($request->isXmlHttpRequest() || $request->request->get('id')){
			$editId = $request->request->get('id');
			$editStatus = $request->request->get('status');
			$repository = $this->getDoctrine()->getRepository(Book::class);	
			$bookList = $repository->update($editId, $editStatus);
			$arrData = ['status' => 'success', 'data' => ['id'=> $editId, 'val' => $editStatus]];
			return new JsonResponse($arrData);
		}
	}
	
	/**
     * Deletes a book entity.
     *
     * @Route("/admin/book/delete/{id}", methods={"GET"}, name="admin_delete_list")  
     */
    public function delete($id): Response
    {   
		$repository = $this->getDoctrine()->getRepository(Book::class);	
		$bookList = $repository->delete($id);       

        $this->addFlash('success', 'Guest Book deleted Successfully!');

        return $this->redirectToRoute('admin_book_list');
    }
}
