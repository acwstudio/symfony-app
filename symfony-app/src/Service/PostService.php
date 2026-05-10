<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PostService
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function store(Post $post): Post
    {
        return $this->postRepository->store($post);
    }
}
