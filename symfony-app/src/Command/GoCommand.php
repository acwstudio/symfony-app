<?php

namespace App\Command;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Tag;
use App\Factory\PostFactory;
use App\Resource\PostResource;
use App\ResponseBuilder\PostResponseBuilder;
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
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private PostService $postService,
        private PostValidator $postValidator,
        private PostResponseBuilder $postResponseBuilder,
        private PostFactory $postFactory,
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
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $data = [
            'title'        => 'My second title edited',
            'description'  => 'My second description edited',
            'content'      => 'My second post edited',
            'published_at' => '2020-12-23',
            'status'       => 2,
            'category_id'  => 1,
        ];

//        $category = $this->em->getRepository(Category::class)->find($data['category_id']);


//        $post = new Post();
//
//        $post->setTitle($data['title']);
//        $post->setDescription($data['description']);
//        $post->setContent($data['content']);
//        $post->setPublishedAt(new \DateTimeImmutable($data['published_at']));
//        $post->setStatus($data['status']);
//        $post->setCategory($category);

        $post = $this->postFactory->makePost($data);

        $this->postValidator->validate($post);

        $post = $this->postService->store($post);
        $post = $this->postResponseBuilder->storePostResponse($post);
        dd($post);
//
//        $this->em->persist($post);
//        $this->em->flush();

//        $posts = $this->postRepository->findAll();
//        dd($posts);
        return Command::SUCCESS;
    }
}
