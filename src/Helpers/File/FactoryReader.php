<?php

namespace App\Helpers\File;

use App\Exception\FileException;
use App\Exception\ServiceException;

class FactoryReader
{
    const EXT_CSV = 'csv';
    const EXT_JSON = 'json';
    const EXT_CACHE = 'cache';

    private static $_classesMap = [
        self::EXT_CSV => CsvReader::class,
        self::EXT_JSON => JsonReader::class,
        self::EXT_CACHE => CacheReader::class,
    ];

    public static function createFileReader(string $forFile): ReaderInterface
    {
        $ext = Helper::getExt($forFile);

        if ($ext === null || !isset(self::$_classesMap[$ext])) {
            throw new FileException(sprintf('Unsupported file format: %s', $ext), FileException::UNSUPPORTED_FORMAT);
        }

        $readerClass = self::$_classesMap[$ext];
        if (!is_subclass_of($readerClass, AbstractReader::class)) {
            throw new ServiceException(sprintf('File reader must instance of %s abstract class, but it does not. Reader class: %s', AbstractReader::class, $readerClass), ServiceException::CODE_INVALID_CONFIG);
        }

        return new $readerClass($forFile, $ext);
    }
}