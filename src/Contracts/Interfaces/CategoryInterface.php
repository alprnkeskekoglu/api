<?php

namespace Dawnstar\Api\Contracts\Interfaces;

interface CategoryInterface
{
    public function getContainer($category);

    public function getPages($category);
}
