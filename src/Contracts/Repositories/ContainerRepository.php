<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\ContainerInterface;
use Dawnstar\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ContainerRepository extends BaseRepository implements ContainerInterface, BaseInterface
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
        return $container->categories()->where('status', 1)->orderBy('lft')->get();
    }

    public function getPages($container)
    {
        return $container->pages()->where('status', 1)->orderBy('order')->get();
    }
}
