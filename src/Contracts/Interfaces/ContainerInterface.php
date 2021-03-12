<?php

namespace Dawnstar\Api\Contracts\Interfaces;

interface ContainerInterface
{
    public function getCategories($container);

    public function getPages($container);
}
