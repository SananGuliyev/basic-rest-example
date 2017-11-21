<?php

namespace Webbala\Infrastructure\Persistence\Doctrine;

use Exception;
use Doctrine\ORM\EntityManager;

abstract class AbstractRepository
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * PageRepository constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param object $entity
     *
     * @return bool
     */
    protected final function saveEntity($entity)
    {
        $result = true;

        try {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            $result = false;
        }

        return $result;
    }

    /**
     * @param array $entities
     *
     * @return bool
     */
    protected final function saveBatchEntities($entities)
    {
        $result = true;

        try {
            foreach ($entities as $entity) {
                $this->entityManager->persist($entity);
            }
            $this->entityManager->flush();
            $this->entityManager->clear();
        } catch (Exception $exception) {
            $result = false;
        }

        return $result;
    }

    /**
     * @param object $entity
     *
     * @return bool
     */
    protected final function updateEntity($entity)
    {
        $result = true;

        try {
            $this->entityManager->merge($entity);
            $this->entityManager->flush();
        } catch (Exception $exception) {
            $result = false;
        }

        return $result;
    }
}