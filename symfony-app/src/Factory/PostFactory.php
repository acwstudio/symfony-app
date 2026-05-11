<?php

declare(strict_types=1);

namespace App\Factory;

use App\DTO\Input\Post\StorePostInputDto;
use App\DTO\Output\Post\PostOutputDto;
use App\Entity\Category;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;

final class PostFactory
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * @throws ORMException
     */
    public function makePost(StorePostInputDto $storePostInputDto): Post
    {
        $category = $this->em->getReference(Category::class, $storePostInputDto->categoryId);
        $post     = new Post();

        $post->setTitle($storePostInputDto->title);
        $post->setDescription($storePostInputDto->description);
        $post->setContent($storePostInputDto->content);
        $post->setPublishedAt($storePostInputDto->publishedAt);
        $post->setStatus($storePostInputDto->status);
        $post->setCategory($category);

        return $post;
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function makeStoreInputDTO(array $data): StorePostInputDto
    {
        $post = new StorePostInputDto();

        $post->title       = $data['title'];
        $post->description = $data['description'];
        $post->content     = $data['content'];
        $post->publishedAt = new \DateTimeImmutable($data['published_at']);
        $post->status      = $data['status'];
        $post->categoryId  = $data['category_id'];

        return $post;
    }

    public function makePostOutputDTO(Post $post): PostOutputDto
    {
        $postOutputDTO = new PostOutputDto();

        $postOutputDTO->id          = $post->getId();
        $postOutputDTO->title       = $post->getTitle();
        $postOutputDTO->description = $post->getDescription();
        $postOutputDTO->content     = $post->getContent();
        $postOutputDTO->publishedAt = $post->getPublishedAt();
        $postOutputDTO->status      = $post->getStatus();
        $postOutputDTO->category    = $post->getCategory();
        $postOutputDTO->tags        = $post->getTags();

        return $postOutputDTO;
    }
}
