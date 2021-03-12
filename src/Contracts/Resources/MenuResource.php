<?php

namespace Dawnstar\Api\Contracts\Resources;

use Dawnstar\Api\Contracts\Repositories\ContainerRepository;
use Dawnstar\Api\Contracts\Repositories\MediaRepository;
use Dawnstar\Api\Contracts\Repositories\MenuRepository;
use Dawnstar\Api\Contracts\Repositories\PageRepository;

class MenuResource extends ResponseResource
{
    public function collectionToArray($menus): array
    {
        $array = [];
        foreach ($menus as $menu) {
            $array[] = $this->singleToArray($menu);
        }

        return $array;
    }

    public function singleToArray($menu): array
    {
        $array = [
            'id' => $menu->id,
            'name' => strip_tags($menu->name),
            'key' => strip_tags($menu->key),
        ];

        $menuContents = (new MenuRepository())->getContents($menu);
        $array['contents'] = (new MenuContentResource())->collectionToArray($menuContents);

        return $array;
    }
}
