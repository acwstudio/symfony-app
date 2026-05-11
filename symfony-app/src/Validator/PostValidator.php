<?php

declare(strict_types=1);

namespace App\Validator;

use App\DTO\Input\StorePostInputDto;
use App\Entity\Post;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class PostValidator
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function validate(StorePostInputDto $post): void
    {
        $errors = $this->validator->validate($post);

        if (count($errors) > 0) {
            $messages = [];

            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }
            throw new \InvalidArgumentException(json_encode($messages));

        }

    }
}
