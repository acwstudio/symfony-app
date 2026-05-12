<?php

declare(strict_types=1);

namespace App\Resource;

use App\DTO\Output\Post\PostOutputDto;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class PostResource
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    /**
     * @throws ExceptionInterface
     */
    public function postItem(PostOutputDto $post): string
    {
        return $this->serializer->serialize($post, 'json', ['groups' => ['post:item']]);
    }

    /**
     * @throws ExceptionInterface
     */
    public function postCollection(array $posts): string
    {
        return $this->serializer->serialize($posts, 'json', ['groups' => ['post:item']]);
    }
}
