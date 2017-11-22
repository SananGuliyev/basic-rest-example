<?php

namespace Webbala\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;
use Webbala\Domain\Models\Offer;

class OfferRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function getAllTest()
    {
        // prepare
        /** @var Offer|\PHPUnit_Framework_MockObject_MockObject $offerMock */
        $offerMock = $this->createMock(Offer::class);

        $expectedResult = [
            $offerMock
        ];

        /** @var EntityRepository|\PHPUnit_Framework_MockObject_MockObject $entityRepositoryMock */
        $entityRepositoryMock = $this->createMock(EntityRepository::class);
        $entityRepositoryMock->expects($this->once())
            ->method('findAll')
            ->willReturn($expectedResult);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Offer::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new OfferRepository($entityManagerMock);
        $result = $classUnderTest->getAll();

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function saveTest()
    {
        // prepare
        /** @var Offer|\PHPUnit_Framework_MockObject_MockObject $offerMock */
        $offerMock = $this->createMock(Offer::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($offerMock);
        $entityManagerMock->expects($this->once())
            ->method('flush');

        // test
        $classUnderTest = new OfferRepository($entityManagerMock);
        $result = $classUnderTest->save($offerMock);

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function saveFailTest()
    {
        // prepare
        /** @var Offer|\PHPUnit_Framework_MockObject_MockObject $offerMock */
        $offerMock = $this->createMock(Offer::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($offerMock)
            ->willThrowException(new \Exception());

        // test
        $classUnderTest = new OfferRepository($entityManagerMock);
        $result = $classUnderTest->save($offerMock);

        // verify
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function updateTest()
    {
        // prepare
        /** @var Offer|\PHPUnit_Framework_MockObject_MockObject $offerMock */
        $offerMock = $this->createMock(Offer::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('merge')
            ->with($offerMock);
        $entityManagerMock->expects($this->once())
            ->method('flush');

        // test
        $classUnderTest = new OfferRepository($entityManagerMock);
        $result = $classUnderTest->update($offerMock);

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function updateFailTest()
    {
        // prepare
        /** @var Offer|\PHPUnit_Framework_MockObject_MockObject $offerMock */
        $offerMock = $this->createMock(Offer::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('merge')
            ->with($offerMock)
            ->willThrowException(new \Exception());

        // test
        $classUnderTest = new OfferRepository($entityManagerMock);
        $result = $classUnderTest->update($offerMock);

        // verify
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function getOfferByIdTest()
    {
        // prepare
        $id = 1903;

        /** @var Offer|\PHPUnit_Framework_MockObject_MockObject $offerMock */
        $offerMock = $this->createMock(Offer::class);

        /** @var EntityRepository|\PHPUnit_Framework_MockObject_MockObject $entityRepositoryMock */
        $entityRepositoryMock = $this->createMock(EntityRepository::class);
        $entityRepositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['id' => $id])
            ->willReturn($offerMock);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Offer::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new OfferRepository($entityManagerMock);
        $result = $classUnderTest->getOfferById($id);

        // verify
        $this->assertEquals($offerMock, $result);
    }
}