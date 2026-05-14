<?php

declare(strict_types=1);

namespace App\Listener\Event\Post;

use App\Event\Post\PostCreatedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: PostCreatedEvent::NAME, method: 'onPostCreated', priority: 100)]
final class PostCreatedListener
{
    public function onPostCreated(PostCreatedEvent $event): void
    {
        dd($event->getPost());
    }
}
