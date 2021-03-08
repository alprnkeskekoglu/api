<?php

namespace Dawnstar\Api\Repositories;

use Dawnstar\Api\Interfaces\ContainerInterface;
use Dawnstar\Models\Container;

class ContainerRepository implements ContainerInterface
{
    public function getAll()
    {
        return Container::where('status', 1)->get();
    }

    public function getById(int $id)
    {
        // TODO: Implement getById() method.
    }

}
