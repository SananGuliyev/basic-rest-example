<?php

namespace Webbala\Application\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Webbala\Domain\Models\Recipient;
use Webbala\Domain\Models\Voucher;
use Webbala\Domain\Offer\RepositoryInterface as OfferRepositoryInterface;
use Webbala\Domain\Recipient\RepositoryInterface as RecipientRepositoryInterface;
use Webbala\Domain\Services\CodeGenerator;
use Webbala\Domain\Voucher\Factory;
use Webbala\Domain\Voucher\RepositoryInterface as VoucherRepositoryInterface;

/**
 * Class VoucherController
 * @package Webbala\Application\Controllers
 */
class VoucherController
{
    /**
     * @var OfferRepositoryInterface
     */
    private $offerRepository;

    /**
     * @var RecipientRepositoryInterface
     */
    private $recipientRepository;

    /**
     * @var VoucherRepositoryInterface
     */
    private $voucherRepository;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var CodeGenerator
     */
    private $codeGenerator;

    /**
     * VoucherController constructor.
     * @param OfferRepositoryInterface $offerRepository
     * @param RecipientRepositoryInterface $recipientRepository
     * @param VoucherRepositoryInterface $voucherRepository
     * @param Factory $factory
     * @param CodeGenerator $codeGenerator
     */
    public function __construct(
        OfferRepositoryInterface $offerRepository,
        RecipientRepositoryInterface $recipientRepository,
        VoucherRepositoryInterface $voucherRepository,
        Factory $factory,
        CodeGenerator $codeGenerator
    ){
        $this->offerRepository = $offerRepository;
        $this->recipientRepository = $recipientRepository;
        $this->voucherRepository = $voucherRepository;
        $this->factory = $factory;
        $this->codeGenerator = $codeGenerator;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response
     */
    public function getVoucherCodes(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();
        $recipient = $this->recipientRepository->getRecipientByEmail($params['email']);
        if ($recipient){
            $status = 200;
            $result = [
                'vouchers' => []
            ];
            /** @var Voucher[] $vouchers */
            $vouchers = $recipient->getVouchers();
            foreach ($vouchers as $voucher) {
                $result['vouchers'][] = [
                    'offer' => $voucher->getOffer()->getName(),
                    'code' => $voucher->getCode(),
                    'expiration' => $voucher->getExpiration()->format('Y-m-d')
                ];
            }
        } else {
            $status = 404;
            $result = [
                'error' => 'Recipient not found!'
            ];
        }
        return $response->withJson($result, $status);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response
     */
    public function generateVouchers(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();
        $offer = $this->offerRepository->getOfferById($params['offerId']);
        if ($offer){
            $expiration = new \DateTime($params['expiration']);
            $vouchers = [];

            /** @var Recipient[] $recipients */
            $recipients = $this->recipientRepository->getAll();
            foreach ($recipients as $recipient) {
                $vouchers[] = $this->factory->createVoucherFromArray([
                    'offer' => $offer,
                    'recipient' => $recipient,
                    'code' => $this->codeGenerator->generate(),
                    'expiration' => $expiration,
                    'isUsed' => 0,
                    'usedAt' => null
                ]);
            }

            if ($this->voucherRepository->saveBatch($vouchers)){
                $status = 200;
                $result = [
                    'status' => 'success'
                ];
            } else {
                $status = 400;
                $result = [
                    'error' => 'Oops... Vouchers can not create.'
                ];
            }
        } else {
            $status = 404;
            $result = [
                'error' => 'Offer not found!'
            ];
        }
        return $response->withJson($result, $status);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response
     */
    public function useVoucher(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();
        $recipient = $this->recipientRepository->getRecipientByEmail($params['email']);
        if ($recipient){
            $now = new \DateTime('now');
            $voucher = $this->voucherRepository->getVoucherByCodeAndRecipient($params['code'], $recipient);

            if ($voucher && $voucher->getExpiration() >= $now){
                $voucher->setIsUsed(1);
                $voucher->setUsedAt($now);
                if ($this->voucherRepository->update($voucher)){
                    $status = 200;
                    $result = [
                        'discount' => $voucher->getOffer()->getDiscount()
                    ];
                } else {
                    $status = 503;
                    $result = [
                        'error' => 'Voucher code can not use right now. Please, try again.'
                    ];
                }
            } else {
                $status = 400;
                $result = [
                    'error' => 'Oops... Voucher code expired.'
                ];
            }
        } else {
            $status = 404;
            $result = [
                'error' => 'Recipient not found!'
            ];
        }
        return $response->withJson($result, $status);
    }
}