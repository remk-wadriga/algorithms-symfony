<?php

namespace App\Exception;

class ServiceException extends \ErrorException
{
    const CODE_INVALID_PARAMS = 2400;
    const CODE_INVALID_CONFIG = 2500;

    public function __construct(?string $message = null, int $code = 0, \Exception $previous = null, int $severity = 1, string $filename = __FILE__, int $lineno = __LINE__)
    {
        if ($message === null) {
            $message = '';
        }
        parent::__construct($message, $code, $severity, $filename, $lineno, $previous);
    }
}