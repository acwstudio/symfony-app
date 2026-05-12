<?php

namespace App\Controller;

use App\DTOValidator\PostDTOValidator;
use App\Entity\Post;
use App\Factory\PostFactory;
use App\ResponseBuilder\PostResponseBuilder;
use App\Service\PostService;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class PostController extends AbstractController
{
    public function __construct(
        private PostService $postService,
        private PostResponseBuilder $postResponseBuilder,
        private PostDTOValidator $postDTOValidator,
        private PostFactory $postFactory,
    )
    {
    }

    #[Route('api/posts', name: 'post.index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $posts = $this->postService->index();

        return $this->postResponseBuilder->indexPostResponse($posts);
    }

    #[Route('api/posts/{id}', name: 'post.show', methods: ['GET'])]
    public function show(Post $post): JsonResponse
    {
        return $this->postResponseBuilder->showPostResponse($post);
    }

    /**
     * @throws ExceptionInterface
     * @throws \DateMalformedStringException
     * @throws ORMException
     */
    #[Route('api/posts', name: 'post.store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $storePostInputDTO = $this->postFactory->makeStorePostInputDTO($data);
        $this->postDTOValidator->validate($storePostInputDTO);
        $post = $this->postService->store($storePostInputDTO);

        return $this->postResponseBuilder->storePostResponse($post);
    }
}
