<?php

namespace App\Repository;

use App\Model\Car;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class CarRepository
{
    private EntityRepository $repository;

    public function __construct(private EntityManager $em)
    {
        $this->repository = $this->em->getRepository(Car::class);
    }

    public function findAll(): array
    {
        $cars = $this->repository->findAll();
        $carsArr = [];

        foreach ($cars as $car) {
            $carsArr[] = $car->toArray();
        }

        return $carsArr;
    }

    public function save(Car $car): void
    {
        $this->em->persist($car);
        $this->em->flush();
    }
}
