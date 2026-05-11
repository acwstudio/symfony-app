<?php

declare(strict_types=1);

namespace App\ResponseBuilder;

use App\Entity\Post;
use App\Resource\PostResource;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PostResponseBuilder
{
    public function __construct(private PostResource $postResource)
    {
    }

    public function storePostResponse(Post $post, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postResource = $this->postResource->postItem($post);

        return new JsonResponse($postResource, $status, $headers, $isJson);
    }
}
