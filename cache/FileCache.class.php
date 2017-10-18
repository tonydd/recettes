<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 14/10/17
 * Time: 17:01
 */

class FileCache implements CacheInterface
{
    const PATH = '/media/ram/';
    
    public function clearValue(string $key)
    {
        if ($this->hasValue($key)) {
            @unlink($this->getFileName($key));
        }
    }

    public function setValue(string $key, $value, int $ttl = self::DEFAULT_TTL)
    {
        $file = $this->getFileName($key);
        $toSerialize = [
            'ttl'   => $ttl === self::TTL_INFINITY ? self::TTL_INFINITY : (time() + $ttl),
            'data'  => $value
        ];
        @file_put_contents($file, serialize($toSerialize));

    }

    public function getValue(string $key)
    {
        $file = $this->getFileName($key);

        if (!self::hasValue($key)) {
            return null;
        }

        $cachedValue    = unserialize(@file_get_contents($file));
        $cachedTtl      = (int)$cachedValue['ttl'];

        if ($cachedTtl !== self::TTL_INFINITY && time() > $cachedTtl) {
            $this->clearValue($key);
            return null;
        }

        return $cachedValue['data'] ?? null;
    }

    public function hasValue(string $key)
    {
        return @file_exists($this->getFileName($key));
    }

    public function getFileName($key)
    {
        return self::PATH . $key . '.data';
    }

    public function clearAll()
    {
        array_map('unlink', glob(self::PATH . "*"));
    }
}