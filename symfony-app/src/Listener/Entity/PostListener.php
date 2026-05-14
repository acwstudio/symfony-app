<?php

declare(strict_types=1);

namespace App\Listener\Entity;

final class PostListener
{
    public function preUpdate()
    {
        dd(33333);
    }
}
