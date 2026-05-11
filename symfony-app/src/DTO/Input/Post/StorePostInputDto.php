<?php

declare(strict_types=1);

namespace App\DTO\Input\Post;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

final class StorePostInputDto
{
    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    #[Length(min: 1, max: 255)]
    public ?string $title = null;

    #[Assert\NotBlank(allowNull: true, normalizer: 'trim')]
    public ?string $description = null;

    #[Assert\NotBlank(allowNull: null, normalizer: 'trim')]
    public ?string $content = null;

    #[Assert\Type(\DateTimeImmutable::class)]
    public ?\DateTimeImmutable $publishedAt = null;

    #[Assert\NotNull]
    #[Assert\Type(type: 'integer')]
    public ?int $status = 1;

    #[Assert\NotNull]
    public ?int $categoryId = null;
}
