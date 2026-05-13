<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function store(Post $post, $isFlush = true): Post
    {
        $this->em->persist($post);

        if ($isFlush) {
            $this->em->flush();
        }

        return $post;
    }

    public function update(Post $post, $isFlush = true): Post
    {
        $this->em->persist($post);

        if ($isFlush) {
            $this->em->flush();
        }

        return $post;
    }
}
