<?php

namespace Webbala\Domain\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

class Recipient
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
     * @var string
     */
    private $email;

    /**
     * @var ArrayCollection
     */
    private $vouchers;

    /**
     * Recipient constructor.
     * @param string $name
     * @param string $email
     */
    public function __construct(string $name, string $email)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->vouchers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param bool $showUsed
     * @return Collection
     */
    public function getVouchers($showUsed = false): Collection
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->gte('expiration', new \DateTime('now')));
        if ($showUsed !== true) {
            $criteria->andWhere(Criteria::expr()->eq('isUsed', 0));
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