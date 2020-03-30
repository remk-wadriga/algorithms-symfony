<?php

namespace App\Helpers\File;

class Entity
{
    public $path;

    public $ext;

    public $data;

    public function __construct(string $path, string $ext)
    {
        $this->path = $path;
        $this->ext = $ext;
    }
}