<?php

namespace Webbala\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;
use Webbala\Domain\Models\Recipient;

class RecipientRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function getAllTest()
    {
        // prepare
        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        $expectedResult = [
            $recipientMock
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
            ->with(Recipient::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new RecipientRepository($entityManagerMock);
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
        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($recipientMock);
        $entityManagerMock->expects($this->once())
            ->method('flush');

        // test
        $classUnderTest = new RecipientRepository($entityManagerMock);
        $result = $classUnderTest->save($recipientMock);

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function saveFailTest()
    {
        // prepare
        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($recipientMock)
            ->willThrowException(new \Exception());

        // test
        $classUnderTest = new RecipientRepository($entityManagerMock);
        $result = $classUnderTest->save($recipientMock);

        // verify
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function updateTest()
    {
        // prepare
        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('merge')
            ->with($recipientMock);
        $entityManagerMock->expects($this->once())
            ->method('flush');

        // test
        $classUnderTest = new RecipientRepository($entityManagerMock);
        $result = $classUnderTest->update($recipientMock);

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function updateFailTest()
    {
        // prepare
        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('merge')
            ->with($recipientMock)
            ->willThrowException(new \Exception());

        // test
        $classUnderTest = new RecipientRepository($entityManagerMock);
        $result = $classUnderTest->update($recipientMock);

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

        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        /** @var EntityRepository|\PHPUnit_Framework_MockObject_MockObject $entityRepositoryMock */
        $entityRepositoryMock = $this->createMock(EntityRepository::class);
        $entityRepositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['id' => $id])
            ->willReturn($recipientMock);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Recipient::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new RecipientRepository($entityManagerMock);
        $result = $classUnderTest->getRecipientById($id);

        // verify
        $this->assertEquals($recipientMock, $result);
    }

    /**
     * @test
     */
    public function getRecipientByEmailTest()
    {
        // prepare
        $email = 'some@email.com';

        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        /** @var EntityRepository|\PHPUnit_Framework_MockObject_MockObject $entityRepositoryMock */
        $entityRepositoryMock = $this->createMock(EntityRepository::class);
        $entityRepositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['email' => $email])
            ->willReturn($recipientMock);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Recipient::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new RecipientRepository($entityManagerMock);
        $result = $classUnderTest->getRecipientByEmail($email);

        // verify
        $this->assertEquals($recipientMock, $result);
    }
}