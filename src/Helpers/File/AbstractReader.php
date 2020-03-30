<?php

namespace App\Helpers\File;

abstract class AbstractReader implements ReaderInterface
{
    /** @var Entity */
    protected $file;

    public function __construct(string $file, string $ext)
    {
        $this->file = new Entity($file, $ext);
    }

    public function getFile(): Entity
    {
        return $this->file;
    }

    public function writeData(array $data)
    {
        file_put_contents($this->file->path, $this->convertData($data));
    }

    abstract public function convertData(array $data): string;
}