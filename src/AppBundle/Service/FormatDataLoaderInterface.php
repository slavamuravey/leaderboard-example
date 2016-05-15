<?php

namespace AppBundle\Service;

interface FormatDataLoaderInterface
{
    /**
     * @param string $url
     * @return array
     */
    public function load($url);
}