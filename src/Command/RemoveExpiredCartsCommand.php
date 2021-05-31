<?php

namespace App\Command;

use App\Repository\Order\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RemoveExpiredCartsCommand extends Command
{
    protected static $defaultName = 'app:remove-expired-carts';
    protected static $defaultDescription = 'Removes carts that have been inactive for a defined period';
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(EntityManagerInterface $em, OrderRepository $orderRepository)
    {
        parent::__construct();
        $this->em = $em;
        $this->orderRepository = $orderRepository;
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('days', InputArgument::OPTIONAL, 'The number of days a cart can remain inactive', 2)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $days = $input->getArgument('days');

        if ($days <= 0) {
            $io->error('The number of days should be greater than 0.');
            return 1;
        }

        // Substracts the number of days from the current date.
        $limitDate = new \DateTime("- $days days");
        $expiredCartsCount = 0;

        while ($carts = $this->orderRepository->findCartsNotModifiedSince($limitDate)) {
            foreach ($carts as $cart) {
                // Items will be deleted on cascade
                $this->em->remove($cart);
            }

            $this->em->flush(); // Executes all deletions
            $this->em->clear(); // Detaches all object from Doctrine

            $expiredCartsCount += count($carts);
        }

        if ($expiredCartsCount) {
            $io->success("$expiredCartsCount cart(s) have been deleted.");
        } else {
            $io->warning("No expired carts.");
        }

        return 0;
    }
}
