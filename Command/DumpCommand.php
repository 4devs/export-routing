<?php

/*
 * This file is part of the 4devs Export Routing package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\ExportRouting\Command;

use FDevs\ExportRouting\RoutesExtractorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DumpCommand extends Command
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var RoutesExtractorInterface
     */
    private $extractor;

    /**
     * DumpCommand constructor.
     *
     * @param SerializerInterface      $serializer
     * @param RoutesExtractorInterface $extractor
     * @param string|null              $name
     */
    public function __construct(SerializerInterface $serializer, RoutesExtractorInterface $extractor, string $name = null)
    {
        $this->serializer = $serializer;
        $this->extractor = $extractor;
        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Dumps exposed routes to the filesystem')
            ->addOption(
                'callback',
                null,
                InputOption::VALUE_REQUIRED,
                'Callback function to pass the routes as an argument.',
                'module.exports = '
            )
            ->addOption(
                'format',
                null,
                InputOption::VALUE_REQUIRED,
                'Format to output routes',
                'js'
            )
            ->addOption(
                'target',
                null,
                InputOption::VALUE_OPTIONAL,
                'Override the target directory to dump routes in.',
                'public/js_routes.js'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $content = $this->serializer->serialize($this->extractor, $input->getOption('format'), ['callback' => $input->getOption('callback')]);
        $target = $input->getOption('target');
        if (false === @file_put_contents($target, $content)) {
            throw new \RuntimeException('Unable to write file '.$target);
        }
    }
}
