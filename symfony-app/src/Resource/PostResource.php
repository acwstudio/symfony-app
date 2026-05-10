<?php

declare(strict_types=1);

namespace App\Resource;

use App\Entity\Post;
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
    public function postItem(Post $post): string
    {
        return $this->serializer->serialize($post, 'json', ['groups' => ['post:item']]);
    }
}
