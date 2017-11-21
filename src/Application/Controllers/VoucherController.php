<?php

namespace Webbala\Application\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Webbala\Domain\Offer\RepositoryInterface as OfferRepositoryInterface;
use Webbala\Domain\Recipient\RepositoryInterface as RecipientRepositoryInterface;
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
     * VoucherController constructor.
     * @param OfferRepositoryInterface $offerRepository
     * @param RecipientRepositoryInterface $recipientRepository
     * @param VoucherRepositoryInterface $voucherRepository
     */
    public function __construct(
        OfferRepositoryInterface $offerRepository,
        RecipientRepositoryInterface $recipientRepository,
        VoucherRepositoryInterface $voucherRepository
    ){
        $this->offerRepository = $offerRepository;
        $this->recipientRepository = $recipientRepository;
        $this->voucherRepository = $voucherRepository;
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
            $vouchers = $recipient->getVouchers();
            foreach ($vouchers as $voucher) {
                $result['vouchers'][] = [
                    'code' => $voucher->getCode(),
                    'offer' => $voucher->getOffer()->getName()
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