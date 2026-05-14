<?php

namespace App\Command;

use App\DTOValidator\StorePostDTOValidator;
use App\Entity\Post;
use App\Entity\User;
use App\Event\Post\PostCreatedEvent;
use App\Factory\PostFactory;
use App\Message\SomeMessage;
use App\ResponseBuilder\PostResponseBuilder;
use App\Service\PostService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

#[AsCommand(
    name: 'go',
    description: 'Add a short description for your command',
)]
class GoCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private PostService $postService,
        private StorePostDTOValidator $postValidator,
        private PostResponseBuilder $postResponseBuilder,
        private PostFactory $postFactory,
        private UserPasswordHasherInterface $passwordHasher,
        private EventDispatcherInterface $eventDispatcher,
        private MessageBusInterface $messageBus,
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
        $this->messageBus->dispatch(new SomeMessage('hello'));

//        $post = $this->em->getRepository(Post::class)->find(5);
//        $post->setTitle(1111999999999999991111);
//        $this->em->persist($post);
//        $this->em->flush();
//
//        $this->eventDispatcher->dispatch(new PostCreatedEvent($post), PostCreatedEvent::NAME);

//        $data = [
//            'email' => 'user@mail.ru',
//            'password' => 'password',
//        ];
//        $user = new User();
//        $user->setEmail($data['email']);
//        $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));
//
//        $this->em->persist($user);
//        $this->em->flush();

//        $data = [
//            'title'        => 'My second title edited',
//            'description'  => 'My second description edited',
//            'content'      => 'My second post edited',
//            'published_at' => '2020-12-23',
//            'status'       => 2,
//            'category_id'  => 1,
//        ];
//
//        $storePostInputDTO = $this->postFactory->makeStorePostInputDTO($data);
//
//        $this->postValidator->validate($storePostInputDTO);
//
//        $post = $this->postService->store($storePostInputDTO);
//        $res = $this->postResponseBuilder->storePostResponse($post);
//        dd($res);

        return Command::SUCCESS;
    }
}
