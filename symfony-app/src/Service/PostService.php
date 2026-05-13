<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Input\Post\StorePostInputDto;
use App\DTO\Input\Post\UpdatePostInputDto;
use App\Entity\Post;
use App\Factory\PostFactory;
use App\Repository\PostRepository;
use Doctrine\ORM\Exception\ORMException;

final class PostService
{
    public function __construct(private PostRepository $postRepository, private PostFactory $postFactory)
    {
    }

    public function index(): array
    {
        return $this->postRepository->findAll();
    }

    /**
     * @throws ORMException
     */
    public function store(StorePostInputDto $storePostInputDto): Post
    {
        $post = $this->postFactory->makePost($storePostInputDto);

        return $this->postRepository->store($post);
    }

    public function update(Post $post, UpdatePostInputDto $updatePostInputDto): Post
    {
        $post = $this->postFactory->editPost($post, $updatePostInputDto);

        return $this->postRepository->update($post);
    }
}
