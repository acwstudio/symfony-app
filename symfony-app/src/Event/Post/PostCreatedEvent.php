<?php

declare(strict_types=1);

namespace App\Event\Post;

use App\Entity\Post;

final class PostCreatedEvent
{
    public const string NAME = 'post_created';

    public function __construct(private Post $post)
    {
    }

    public function getPost(): Post
    {
        return $this->post;
    }
}
