<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Tag;
use App\Resource\PostResource;
use App\Service\PostService;
use App\Validator\PostValidator;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private PostService $postService,
        private PostValidator $postValidator,
        private PostResource $postResource,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    /**
     * @throws \DateMalformedStringException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = [
            'title'        => 'My second title edited',
            'description'  => 'My second description edited',
            'content'      => 'My second post edited',
            'published_at' => '2020-12-23',
            'status'       => '2',
            'category_id'  => '1',
        ];

        $category = $this->em->getRepository(Category::class)->find($data['category_id']);

//        $post = $this->em->getRepository(Post::class)->find(2);
//        $tag  = $this->em->getRepository(Tag::class)->find(1);
//        $post->addTag($tag);
        $post = new Post();

        $post->setTitle($data['title']);
        $post->setDescription($data['description']);
        $post->setContent($data['content']);
        $post->setPublishedAt(new \DateTimeImmutable($data['published_at']));
        $post->setStatus($data['status']);
        $post->setCategory($category);

        $this->postValidator->validate($post);

        $post = $this->postService->store($post);
        $post = $this->postResource->postItem($post);
        dd($post);
//
//        $this->em->persist($post);
//        $this->em->flush();

//        $posts = $this->postRepository->findAll();
//        dd($posts);
        return Command::SUCCESS;
    }
}
