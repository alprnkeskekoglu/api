<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\CategoryInterface;
use Dawnstar\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CategoryRepository extends BaseRepository implements BaseInterface, CategoryInterface
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
}
