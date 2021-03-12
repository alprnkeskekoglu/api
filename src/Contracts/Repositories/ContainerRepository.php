<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\ContainerInterface;
use Dawnstar\Models\Container;

class ContainerRepository implements ContainerInterface, BaseInterface
{
    public function getAll()
    {
        return Container::where('status', 1)->where('website_id', dawnstar()->website->id)->get();
    }

    public function getById(int $id)
    {
        return Container::find($id);
    }

    public function getCategories($container)
    {
        // TODO: Implement getCategories() method.
    }

    public function getPages($container)
    {
        // TODO: Implement getPages() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($model)
    {
        // TODO: Implement update() method.
    }

    public function destroy($model)
    {
        // TODO: Implement destroy() method.
    }
}
