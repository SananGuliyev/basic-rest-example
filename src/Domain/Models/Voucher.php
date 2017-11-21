<?php

namespace Webbala\Domain\Models;

class Voucher
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $offerId;

    /**
     * @var int
     */
    private $recipientId;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $expiration;

    /**
     * @var int
     */
    private $isUsed;

    /**
     * @var string
     */
    private $usedAt;

    public function __construct(
        int $offerId,
        int $recipientId,
        string $code,
        string $expiration,
        int $isUsed,
        string $usedAt
    ) {
        $this->setOfferId($offerId);
        $this->setRecipientId($recipientId);
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
     * @return int
     */
    public function getOfferId(): int
    {
        return $this->offerId;
    }

    /**
     * @param int $offerId
     */
    public function setOfferId(int $offerId)
    {
        $this->offerId = $offerId;
    }

    /**
     * @return int
     */
    public function getRecipientId(): int
    {
        return $this->recipientId;
    }

    /**
     * @param int $recipientId
     */
    public function setRecipientId(int $recipientId)
    {
        $this->recipientId = $recipientId;
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
     * @return string
     */
    public function getExpiration(): string
    {
        return $this->expiration;
    }

    /**
     * @param string $expiration
     */
    public function setExpiration(string $expiration)
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
     * @return string
     */
    public function getUsedAt(): string
    {
        return $this->usedAt;
    }

    /**
     * @param string $usedAt
     */
    public function setUsedAt(string $usedAt)
    {
        $this->usedAt = $usedAt;
    }

}