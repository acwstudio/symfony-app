<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

final class ValidateException extends \RuntimeException
{
    public function __construct(private array $errors)
    {
        parent::__construct('Invalidate arguments', 422);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
