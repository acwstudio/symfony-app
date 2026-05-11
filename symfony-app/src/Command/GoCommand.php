<?php

namespace App\Command;

use App\DTOValidator\PostDTOValidator;
use App\Factory\PostFactory;
use App\ResponseBuilder\PostResponseBuilder;
use App\Service\PostService;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private PostService $postService,
        private PostDTOValidator $postValidator,
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
     * @throws ORMException
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

        $storePostInputDTO = $this->postFactory->makeStoreInputDTO($data);

        $this->postValidator->validate($storePostInputDTO);

        $post = $this->postService->store($storePostInputDTO);
        $res = $this->postResponseBuilder->storePostResponse($post);
        dd($res);

        return Command::SUCCESS;
    }
}
