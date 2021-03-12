<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\CategoryInterface;
use Dawnstar\Api\Contracts\Interfaces\PageInterface;
use Dawnstar\Models\Category;
use Dawnstar\Models\Page;

class PageRepository implements PageInterface, BaseInterface
{
    public function getAll()
    {
        return Page::where('status', 1)
            ->whereHas('container', function ($q) {
                $q->where('website_id', dawnstar()->website->id);
            })
            ->orderBy('order')
            ->get();
    }

    public function getById(int $id)
    {
        return Page::find($id);
    }

    public function getContainer($page)
    {
        return $page->container;
    }

    public function getCategories($page)
    {
        return $page->categories()->where('status', 1)->orderBy('lft')->get();
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
