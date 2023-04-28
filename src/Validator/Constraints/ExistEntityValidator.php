<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ExistEntityValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint): void
    {

        if (!$constraint instanceof ExistEntity) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\ExistEntity');
        }


        if (null === $value) {
            return;
        }
        $repository = $this->entityManager->getRepository($constraint->entityclass);

        $title = $value->getTitle();
        $description = $value->getDescription();
        $existingFilm = $repository->createQueryBuilder('f')
            ->andWhere('f.title=:title')
            ->andWhere('f.description=:description')
            ->setParameter('title', $title)
            ->setParameter('description', $description)
            ->getQuery()
            ->getResult();

        if ($existingFilm) {
            $this->context->buildViolation($constraint->message)
                ->setCode(422)
                ->atPath('title and description')
                ->addViolation();
        }
    }
}