<?php
/**
 * This file contains an exception thrown
 * when no message is provided to mail.
 */

namespace Ssf\Mail\Exceptions;

use Throwable;

/**
 * Class NullMessageException
 * @package Ssf\Mail\Exceptions
 */
class NullMessageException extends \Exception
{
    /**
     * NullMessageException constructor.
     * @param null $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?? sprintf("Please provide a message with %s::create() or as parameter", \Ssf\Mail\Facades\Mail::class), $code, $previous);
    }
}