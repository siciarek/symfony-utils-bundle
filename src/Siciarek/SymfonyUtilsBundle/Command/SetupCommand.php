<?php
namespace Siciarek\SymfonyUtilsBundle\Command;

set_time_limit(0);
ini_set('memory_limit', '512M');

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressHelper;

use Symfony\Component\DomCrawler\Crawler;


class SetupCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName("siciarek:utils:setup")
            ->setDescription("Sets up utilities.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("OK");
    }
}
