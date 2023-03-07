<?php

namespace Util;

final readonly class Cache
{
    private string $filename;

    public function __construct(string $id, private string $lifetime = '5 minutes')
    {
        $this->filename = CACHE_STORAGE . DIRECTORY_SEPARATOR . sha1($id);
    }

    public function save(\Serializable $data): int|false
    {
        $isCacheWritable = file_exists(CACHE_STORAGE) && is_dir(CACHE_STORAGE) && is_writable(CACHE_STORAGE);

        if (false === $isCacheWritable) {
            return false;
        }

        $lifetime = strtotime($this->lifetime);

        $content = serialize([
            'lifetime' => $lifetime,
            'data' => $data
        ]);

        return file_put_contents($this->filename, $content);
    }

    public function retrieve(): mixed
    {
        $isFileReadable = file_exists($this->filename) && is_readable($this->filename);

        if (false === $isFileReadable) {
            return null;
        }

        $content = file_get_contents($this->filename);

        $cache = unserialize($content);

        $cacheExpired = $cache['lifetime'] > time();

        return $cacheExpired ? $cache['data'] : unlink($this->filename);
    }
}
