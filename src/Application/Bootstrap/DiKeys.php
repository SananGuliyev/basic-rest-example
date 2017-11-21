<?php

namespace Webbala\Application\Bootstrap;

/**
 * Class DiKeys
 * @package Webbala\Application\Bootstrap
 */
class DiKeys
{
    const APPLICATION_CONFIG = 'applicationConfig';
    const DOCTRINE_ENTITY_MANAGER = 'doctrineEntityManager';
    const CODE_GENERATOR = 'codeGenerator';

    // Controllers
    const OFFER_CONTROLLER = 'offerController';
    const RECIPIENT_CONTROLLER = 'recipientController';
    const VOUCHER_CONTROLLER = 'voucherController';

    // Repositories
    const OFFER_REPOSITORY = 'offerRepository';
    const RECIPIENT_REPOSITORY = 'recipientRepository';
    const VOUCHER_REPOSITORY = 'voucherRepository';

    // Error Handlers
    const NOT_ALLOW_HANDLER = 'notAllowedHandler';
    const NOT_FOUND_HANDLER = 'notFoundHandler';
    const SLIM_ERROR_HANDLER = 'errorHandler';
    const RUNTIME_ERROR_HANDLER = 'phpErrorHandler';
}
