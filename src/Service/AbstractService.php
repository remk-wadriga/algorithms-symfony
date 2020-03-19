<?php

namespace App\Service;

use App\Helpers\File\FileReaderFactory;
use App\Helpers\File\FileReaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractService
{
    protected $em;
    protected $container;

    /** @var FileReaderInterface[] */
    protected $fileReaders = [];

    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function getParam($name, $defaultValue = null)
    {
        if (!$this->container->hasParameter($name)) {
            return $defaultValue;
        }
        return $this->container->getParameter($name);
    }

    public function getFileReader(string $forFile): FileReaderInterface
    {
        if (isset($this->fileReaders[$forFile])) {
            return $this->fileReaders[$forFile];
        }
        if (!file_exists($forFile)) {
            $forFile = $this->getParam('files_dir') . DIRECTORY_SEPARATOR . $forFile;
        }
        return $this->fileReaders[$forFile] = FileReaderFactory::createFileReader($forFile);
    }
}