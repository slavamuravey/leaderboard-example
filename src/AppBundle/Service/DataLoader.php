<?php

namespace AppBundle\Service;

use Doctrine\Common\Cache\CacheProvider;

class DataLoader
{
    /**
     * @var JsonDataLoader
     */
    private $formatDataLoader;

    /**
     * @var CacheProvider
     */
    private $cache;

    /**
     * @var string
     */
    private $url;

    /**
     * @param FormatDataLoaderInterface $formatDataLoader
     * @param CacheProvider $cache
     */
    public function __construct(FormatDataLoaderInterface $formatDataLoader, CacheProvider $cache = null)
    {
        $this->formatDataLoader = $formatDataLoader;
        $this->cache = $cache;
    }

    public function loadSourceData()
    {
        $key = spl_object_hash($this);

        if (null === $this->cache) {
            return $this->formatDataLoader->load($this->getUrl());
        }

        if (!$this->cache->contains($key)) {
            $this->cache->save($key, $this->formatDataLoader->load($this->getUrl()));
        }

        return $this->cache->fetch($key);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}