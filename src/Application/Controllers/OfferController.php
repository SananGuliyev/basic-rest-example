<?php

namespace Webbala\Application\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Webbala\Domain\Offer\Factory;
use Webbala\Domain\Offer\RepositoryInterface as OfferRepositoryInterface;

/**
 * Class OfferController
 * @package Webbala\Application\Controllers
 */
class OfferController
{
    /**
     * @var OfferRepositoryInterface
     */
    private $offerRepository;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * VoucherController constructor.
     * @param OfferRepositoryInterface $offerRepository
     * @param Factory $factory
     */
    public function __construct(
        OfferRepositoryInterface $offerRepository,
        Factory $factory
    ){
        $this->offerRepository = $offerRepository;
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param mixed $args
     * @return Response
     */
    public function add(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();

        $offer = $this->factory->createOfferFromArray($params);

        if ($saveResult = $this->offerRepository->save($offer)){
            $status = 200;
            $result = [
                'status' => 'success'
            ];
        } else {
            $status = 400;
            $result = [
                'status' => 'error'
            ];
        }

        return $response->withJson($result, $status);
    }
}