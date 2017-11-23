<?php

namespace Webbala\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;
use Webbala\Domain\Models\Recipient;
use Webbala\Domain\Models\Voucher;

class VoucherRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function getAllTest()
    {
        // prepare
        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        $expectedResult = [
            $voucherMock
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
            ->with(Voucher::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
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
        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($voucherMock);
        $entityManagerMock->expects($this->once())
            ->method('flush');

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->save($voucherMock);

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function saveFailTest()
    {
        // prepare
        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($voucherMock)
            ->willThrowException(new \Exception());

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->save($voucherMock);

        // verify
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function saveBatchTest()
    {
        // prepare
        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        $vouchers = [
            $voucherMock
        ];

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->any())
            ->method('persist')
            ->with($voucherMock);
        $entityManagerMock->expects($this->once())
            ->method('flush');
        $entityManagerMock->expects($this->once())
            ->method('clear');

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->saveBatch($vouchers);

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function saveBatchFailTest()
    {
        // prepare
        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        $vouchers = [
            $voucherMock
        ];

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('persist')
            ->with($voucherMock)
            ->willThrowException(new \Exception());

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->saveBatch($vouchers);

        // verify
        $this->assertFalse($result);
    }

    /**
     * @test
     */
    public function updateTest()
    {
        // prepare
        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('merge')
            ->with($voucherMock);
        $entityManagerMock->expects($this->once())
            ->method('flush');

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->update($voucherMock);

        // verify
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function updateFailTest()
    {
        // prepare
        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('merge')
            ->with($voucherMock)
            ->willThrowException(new \Exception());

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->update($voucherMock);

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

        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        /** @var EntityRepository|\PHPUnit_Framework_MockObject_MockObject $entityRepositoryMock */
        $entityRepositoryMock = $this->createMock(EntityRepository::class);
        $entityRepositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['id' => $id])
            ->willReturn($voucherMock);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Voucher::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->getVoucherById($id);

        // verify
        $this->assertEquals($voucherMock, $result);
    }

    /**
     * @test
     */
    public function getVoucherByCodeAndRecipientTest()
    {
        // prepare
        $code = 'someCode';

        /** @var Voucher|\PHPUnit_Framework_MockObject_MockObject $voucherMock */
        $voucherMock = $this->createMock(Voucher::class);

        /** @var Recipient|\PHPUnit_Framework_MockObject_MockObject $recipientMock */
        $recipientMock = $this->createMock(Recipient::class);

        /** @var EntityRepository|\PHPUnit_Framework_MockObject_MockObject $entityRepositoryMock */
        $entityRepositoryMock = $this->createMock(EntityRepository::class);
        $entityRepositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['code' => $code,'recipient' => $recipientMock])
            ->willReturn($voucherMock);

        /** @var EntityManager|\PHPUnit_Framework_MockObject_MockObject $entityManagerMock */
        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->with(Voucher::class)
            ->willReturn($entityRepositoryMock);

        // test
        $classUnderTest = new VoucherRepository($entityManagerMock);
        $result = $classUnderTest->getVoucherByCodeAndRecipient($code, $recipientMock);

        // verify
        $this->assertEquals($voucherMock, $result);
    }
}