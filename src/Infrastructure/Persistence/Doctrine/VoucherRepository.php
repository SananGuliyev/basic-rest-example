<?php

namespace Webbala\Infrastructure\Persistence\Doctrine;

use Webbala\Domain\Models\Voucher;
use Webbala\Domain\Voucher\RepositoryInterface;

class VoucherRepository extends AbstractRepository implements RepositoryInterface
{

    /**
     * @return Voucher[]
     */
    public function getAll()
    {
        return $this->entityManager->getRepository(Voucher::class)->findAll();
    }

    /**
     * @param Voucher $voucher
     *
     * @return bool
     */
    public function save(Voucher $voucher)
    {
        return parent::saveEntity($voucher);
    }

    /**
     * @param array $vouchers
     *
     * @return bool
     */
    public function saveBatch(array $vouchers)
    {
        return parent::saveBatchEntities($vouchers);
    }

    /**
     * @param Voucher $voucher
     *
     * @return bool
     */
    public function update(Voucher $voucher)
    {
        return parent::updateEntity($voucher);
    }

    /**
     * @param int $id
     *
     * @return Voucher | object | null
     */
    public function getVoucherById(int $id)
    {
        // TODO: Implement getReportById() method.
    }
}