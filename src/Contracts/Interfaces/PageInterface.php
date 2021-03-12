<?php

namespace Dawnstar\Api\Contracts\Interfaces;

interface PageInterface
{
    public function getContainer($page);

    public function getCategories($page);
}
