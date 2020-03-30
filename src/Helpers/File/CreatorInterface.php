<?php

namespace App\Helpers\File;

interface CreatorInterface
{
    public function setDir(string $directory);

    public function setFileName(string $fileName);

    public function setData(string $data);

    public function getExt(): string;

    public function getName(): string;

    public function create(string $size = null): Entity;

    public function getFile(): Entity;
}