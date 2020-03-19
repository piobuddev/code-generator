<?php declare(strict_types=1);

namespace CodeGenerator\Command;

use CodeGenerator\File\Writer\WriterInterface;
use CodeGenerator\Template\Loader;
use CodeGenerator\Template\RendererFactoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    protected static $defaultName = 'generate';

    /**
     * @var \CodeGenerator\Template\RendererFactoryInterface
     */
    private RendererFactoryInterface $rendererFactory;

    /**
     * @var \CodeGenerator\Template\Loader
     */
    private Loader $loader;

    /**
     * @var \CodeGenerator\File\Writer\WriterInterface
     */
    private WriterInterface $writer;

    /**
     * @param string|null                                      $name
     * @param \CodeGenerator\Template\RendererFactoryInterface $rendererFactory
     * @param \CodeGenerator\Template\Loader                   $loader
     * @param \CodeGenerator\File\Writer\WriterInterface       $writer
     */
    public function __construct(
        string $name = null,
        RendererFactoryInterface $rendererFactory,
        Loader $loader,
        WriterInterface $writer
    ) {
        $this->rendererFactory = $rendererFactory;
        $this->loader          = $loader;
        $this->writer          = $writer;

        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generates code')
            ->setHelp('This command allows you to generate code based on the templates');

        $this
            ->addArgument('templates', InputArgument::REQUIRED, 'Path to the templates')
            ->addArgument('output', InputArgument::REQUIRED, 'Output directory')
            ->addArgument('context', InputArgument::REQUIRED, 'Json file providing templates context');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @throws \Exception
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $context = $input->getArgument('context');
        if (null !== $context) {
            $input->setArgument(
                'context',
                json_decode(file_get_contents($context), true)
            );
        }

        parent::initialize($input, $output);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $context   = $input->getArgument('context');
        $contexts  = $context !== array_values($context) ? [$context] : (array)$context;
        $templates = $input->getArgument('templates');
        $twig      = $this->rendererFactory->create($templates);

        foreach ($this->loader->load($templates) as $file) {
            foreach ($contexts as $context) {
                $pathname    = $file->getRelativePathname();
                $content     = $twig->renderTemplate($pathname, $context);
                $destination = $this->getDestPath(
                    $input->getArgument('output'),
                    $twig->renderString($pathname, $context)
                );

                $this->writer->write($content, $destination);
            }
        }

        return 0;
    }

    /**
     * @param string $output
     * @param string $srcFilePathname
     *
     * @return string
     */
    protected function getDestPath(string $output, string $srcFilePathname): string
    {
        $destPathname = str_replace(Loader::TEMPLATE_EXTENSION, '', $srcFilePathname);

        return implode('/', [$output, $destPathname]);
    }
}
