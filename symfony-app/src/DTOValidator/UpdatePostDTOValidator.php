<?php

declare(strict_types=1);

namespace App\DTOValidator;

use App\DTO\Input\Post\UpdatePostInputDto;
use App\Exception\ValidateException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UpdatePostDTOValidator
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function validate(UpdatePostInputDto $post): void
    {
        $errors = $this->validator->validate($post);

        if (count($errors) > 0) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }

            throw new ValidateException($messages);
        }
    }
}
