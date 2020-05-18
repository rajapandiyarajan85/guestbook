<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return Book[] Returns an array of Book objects
    */
    
    public function findAll($restrict=null)
    {		
		$entityManager = $this->getEntityManager();
		$restrictForUsers = ($restrict) ? 'where b.status=1' : '';		
		// Using create query
		$qb = $entityManager->createQuery(
            'SELECT b, u.name FROM App\Entity\Book b left join App\Entity\User u WITH u.id = b.userId '.$restrictForUsers.' ORDER BY b.date_created DESC'
        );		
		//where b.status=0 
		return $qb->getResult();		
    }
	
	public function update($id, $status) {
		
		$updateStatus = ($status) ? 0 : 1 ; 		
		// Using query builder
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		$qb = $queryBuilder->update('App\Entity\Book', 'b')
					->set('b.status', '?1')
					->where('b.id = ?2')
					->setParameter(1, $updateStatus)
					->setParameter(2, $id)
					->getQuery()
					;		
		return $qb->execute();
	}
	
	public function delete($id) {
		$queryBuilder = $this->getEntityManager()->createQueryBuilder();
		$qb = $queryBuilder->delete('App\Entity\Book', 'b')					
					->where('b.id = ?1')
					->setParameter(1, $id)
					->getQuery()
					;		
		return $qb->execute();
	}   
}
