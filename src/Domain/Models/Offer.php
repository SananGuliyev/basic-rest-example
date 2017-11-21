<?php

namespace Webbala\Domain\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

class Offer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $discount;

    /**
     * @var ArrayCollection
     */
    private $vouchers;

    /**
     * Offer constructor.
     * @param string $name
     * @param int $discount
     */
    public function __construct(string $name, int $discount)
    {
        $this->setName($name);
        $this->setDiscount($discount);
        $this->vouchers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @param int $discount
     */
    public function setDiscount(int $discount)
    {
        $this->discount = $discount;
    }

    /**
     * @param bool $showUsed
     * @return Collection
     */
    public function getVouchers($showUsed = false): Collection
    {
        $criteria = Criteria::create();
        if ($showUsed !== true) {
            $criteria->where(Criteria::expr()->eq('isUsed', 0));
        }
        return $this->vouchers->matching($criteria);
    }

    /**
     * @param Voucher $voucher
     */
    public function addVoucher(Voucher $voucher)
    {
        $this->vouchers[] = $voucher;
    }
}