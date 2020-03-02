<?php

namespace Sichkarev\Task\DataProviders;

use SplFileObject;
use Traversable;

/**
 * Class FileDataProvider
 *
 * @package Sichkarev\Task\DataProviders
 */
class FileDataProvider implements DataProviderInterface
{
    private SplFileObject $file;

    /**
     * FileParser constructor.
     */
    public function __construct(string $file)
    {
        $this->setFile($file);
    }

    private function setFile(string $file): void
    {
        $this->file = new SplFileObject($file);
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): Traversable
    {
        return $this->readFile();
    }

    private function readFile(): \Generator
    {
        while ($this->file->valid()) {
            yield $this->file->fgets();
        }
    }
}
