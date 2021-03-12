<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\CategoryInterface;
use Dawnstar\Api\Contracts\Interfaces\MenuInterface;
use Dawnstar\Api\Contracts\Interfaces\PageInterface;
use Dawnstar\Models\Category;
use Dawnstar\Models\Menu;
use Dawnstar\Models\Page;

class MenuRepository implements MenuInterface, BaseInterface
{
    public function getAll()
    {
        return Menu::where('status', 1)
            ->where('website_id', dawnstar()->website->id)
            ->get();
    }

    public function getById(int $id)
    {
        return Menu::find($id);
    }

    public function getContents($menu)
    {
        return $menu->contents()->where('language_id', dawnstar()->language->id)->where('parent_id', 0)->where('status', 1)->orderBy('lft')->get();
    }

    public function getContentChildren($menuContent)
    {
        return $menuContent->children()->where('language_id', dawnstar()->language->id)->where('status', 1)->orderBy('lft')->get();
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
