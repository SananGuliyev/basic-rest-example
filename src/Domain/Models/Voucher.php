<?php

namespace Webbala\Domain\Models;

class Voucher
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var \DateTime
     */
    private $expiration;

    /**
     * @var int
     */
    private $isUsed;

    /**
     * @var \DateTime | null
     */
    private $usedAt;

    /**
     * @var Offer
     */
    private $offer;

    /**
     * @var Recipient
     */
    private $recipient;

    public function __construct(
        Offer $offer,
        Recipient $recipient,
        string $code,
        \DateTime $expiration,
        int $isUsed,
        $usedAt
    ) {
        $this->setOffer($offer);
        $this->setRecipient($recipient);
        $this->setCode($code);
        $this->setExpiration($expiration);
        $this->setIsUsed($isUsed);
        $this->setUsedAt($usedAt);
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
     * @return Offer
     */
    public function getOffer(): Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     */
    public function setOffer(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * @return Recipient
     */
    public function getRecipient(): Recipient
    {
        return $this->recipient;
    }

    /**
     * @param Recipient $recipient
     */
    public function setRecipient(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return \DateTime
     */
    public function getExpiration(): \DateTime
    {
        return $this->expiration;
    }

    /**
     * @param \DateTime $expiration
     */
    public function setExpiration(\DateTime $expiration)
    {
        $this->expiration = $expiration;
    }

    /**
     * @return int
     */
    public function getIsUsed(): int
    {
        return $this->isUsed;
    }

    /**
     * @param int $isUsed
     */
    public function setIsUsed(int $isUsed)
    {
        $this->isUsed = $isUsed;
    }

    /**
     * @return \DateTime | null
     */
    public function getUsedAt()
    {
        return $this->usedAt;
    }

    /**
     * @param \DateTime | null $usedAt
     */
    public function setUsedAt($usedAt)
    {
        $this->usedAt = $usedAt;
    }

}