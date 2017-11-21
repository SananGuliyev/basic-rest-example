<?php

namespace Webbala\Application\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Webbala\Domain\Models\Voucher;
use Webbala\Domain\Recipient\Factory;
use Webbala\Domain\Recipient\RepositoryInterface as RecipientRepositoryInterface;

/**
 * Class RecipientController
 * @package Webbala\Application\Controllers
 */
class RecipientController
{

    /**
     * @var RecipientRepositoryInterface
     */
    private $recipientRepository;

    /**
     * @var Factory
     */
    private $factory;

    /**
     * VoucherController constructor.
     * @param RecipientRepositoryInterface $recipientRepository
     * @param Factory $factory
     */
    public function __construct(
        RecipientRepositoryInterface $recipientRepository,
        Factory $factory
    ){
        $this->recipientRepository = $recipientRepository;
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

        $recipient = $this->factory->createRecipientFromArray($params);

        if ($saveResult = $this->recipientRepository->save($recipient)){
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