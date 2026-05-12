<?php

declare(strict_types=1);

namespace App\ResponseBuilder;

use App\Entity\Post;
use App\Factory\PostFactory;
use App\Resource\PostResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class PostResponseBuilder
{
    public function __construct(private PostResource $postResource, private PostFactory $postFactory)
    {
    }

    public function indexPostResponse(array $posts, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTOs = $this->postFactory->makePostOutputDTOs($posts);

        $postResource = $this->postResource->postCollection($postOutputDTOs);

        return new JsonResponse($postResource, $status, $headers, $isJson);
    }

    /**
     * @throws ExceptionInterface
     */
    public function storePostResponse(Post $post, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTO = $this->postFactory->makePostOutputDTO($post);
        $postResource = $this->postResource->postItem($postOutputDTO);

        return new JsonResponse($postResource, $status, $headers, $isJson);
    }

    /**
     * @throws ExceptionInterface
     */
    public function showPostResponse(Post $post, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $postOutputDTO = $this->postFactory->makePostOutputDTO($post);
        $postResource = $this->postResource->postItem($postOutputDTO);

        return new JsonResponse($postResource, $status, $headers, $isJson);
    }
}
