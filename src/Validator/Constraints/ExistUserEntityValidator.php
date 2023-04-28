<?php

namespace App\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ExistUserEntityValidator extends ConstraintValidator
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

        if (!$constraint instanceof ExistUserEntity) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\ExistEntity');
        }


        if (null === $value) {
            return;
        }
        $repository = $this->entityManager->getRepository($constraint->entityclass);

        $email = $value->getEmail();
        $existingUser = $repository->createQueryBuilder('u')
            ->andWhere('u.email=:email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult();
       // dd($existingUser);

        if ($existingUser) {
            $this->context->buildViolation($constraint->message)
                ->setCode(422)
                ->atPath('email')
                ->addViolation();
        }
    }
}