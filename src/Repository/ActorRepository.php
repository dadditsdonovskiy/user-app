<?php

namespace App\Repository;

use App\DTO\Actor\CreateActorDto;
use App\Entity\Actor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Actor>
 *
 * @method Actor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actor[]    findAll()
 * @method Actor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actor::class);
    }

    public function createActor(CreateActorDto $dto): Actor
    {
        $actor = new Actor();
        $actor->setFullName($dto->getFullName());
        $actor->setDateBirth(date_create_immutable($dto->getBirthDate()));

        $this->save($actor, true);

        return $actor;
    }

    /**
     * @param int $filmId
     * @return Actor[]|array
     */
    public function getActorsByFilm(int $filmId): array
    {
        $qb = $this->createQueryBuilder('a');
        $qb
            ->select('a.id')->addSelect('a.full_name fullName')->addSelect('a.date_birth birth')
            ->andWhere('f.id = :filmId')
            ->leftJoin('a.films', 'f')
            ->setParameter('filmId', $filmId);


        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function save(Actor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Actor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Actor[] Returns an array of Actor objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Actor
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
