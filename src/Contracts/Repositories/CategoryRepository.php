<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\CategoryInterface;
use Dawnstar\Models\Category;

class CategoryRepository implements CategoryInterface, BaseInterface
{
    public function getAll()
    {
        return Category::where('status', 1)
            ->whereHas('container', function ($q) {
                $q->where('website_id', dawnstar()->website->id);
            })
            ->orderBy('lft')
            ->get();
    }

    public function getById(int $id)
    {
        return Category::find($id);
    }

    public function getContainer($category)
    {
        return $category->container;
    }

    public function getPages($category)
    {
        return $category->pages()->where('status', 1)->orderBy('order')->get();
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
