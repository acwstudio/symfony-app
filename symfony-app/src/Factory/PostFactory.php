<?php

declare(strict_types=1);

namespace App\Factory;

use App\DTO\Input\StorePostInputDto;
use App\Entity\Category;
use App\Entity\Post;
use App\Validator\PostValidator;
use Doctrine\ORM\EntityManagerInterface;

final class PostFactory
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function makePost(array $data): Post
    {
        $category = $this->em->getRepository(Category::class)->find($data['category_id']);
        $post = new Post();

        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        $post->setContent($data['content']);
        $post->setPublishedAt(new \DateTimeImmutable($data['published_at']));
        $post->setStatus($data['status']);
        $post->setCategory($category);

        return $post;
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function makeStoreInputDTO(array $data): StorePostInputDto
    {
        $category = $this->em->getRepository(Category::class)->find($data['category_id']);
        $post     = new StorePostInputDto();

        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        $post->setContent($data['content']);
        $post->setPublishedAt(new \DateTimeImmutable($data['published_at']));
        $post->setStatus($data['status']);
        $post->setCategory($category);

        return $post;
    }
}
