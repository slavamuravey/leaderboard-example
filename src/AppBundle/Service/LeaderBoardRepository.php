<?php

namespace AppBundle\Service;

use Doctrine\Common\Cache\CacheProvider;

class LeaderBoardRepository
{
    /**
     * @var DataLoader
     */
    private $dataLoader;

    /**
     * @var CacheProvider
     */
    private $cache;

    /**
     * @var string
     */
    private $root;

    /**
     * @param DataLoader $dataLoader
     * @param CacheProvider $cache
     */
    public function __construct(DataLoader $dataLoader, CacheProvider $cache = null)
    {
        $this->dataLoader = $dataLoader;
        $this->cache = $cache;
    }

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param string $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return DataLoader
     */
    public function getDataLoader()
    {
        return $this->dataLoader;
    }

    public function findAll()
    {
        return $this->getDataLoader()->loadSourceData()[$this->getRoot()];
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $data = $this->findAll();
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data));
        $outputArray = [];

        foreach ($iterator as $sub) {
            $subIterator = $iterator->getSubIterator();
            $matched = true;
            foreach ($criteria as $key => $value) {
                if ($subIterator[$key] !== $value) {
                     $matched = false;
                }
            }
            if ($matched) {
                $outputArray[] = iterator_to_array($subIterator);
            }
        }

        return $outputArray;
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
    }
}