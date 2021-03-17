<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\CategoryInterface;
use Dawnstar\Api\Contracts\Interfaces\PageInterface;
use Dawnstar\Models\Category;
use Dawnstar\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PageRepository extends BaseRepository implements PageInterface, BaseInterface
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
}
