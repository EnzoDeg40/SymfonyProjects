<?php

namespace App\Repository;

use App\Entity\Persons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Persons>
 *
 * @method Persons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Persons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Persons[]    findAll()
 * @method Persons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persons::class);
    }

    public function add(Persons $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Persons $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Persons[]
     */
    public function findListAdults($value): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Persons p
            WHERE p.age > :age'
        )->setParameter('age', $value);

        // returns an array of Product objects
        return $query->getResult();
    }

//    /**
//    * @return Persons[] Returns an array of Persons objects
//    */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.age >= :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Persons
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
