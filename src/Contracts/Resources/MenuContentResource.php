<?php

namespace Dawnstar\Api\Contracts\Resources;

use Dawnstar\Api\Contracts\Repositories\ContainerRepository;
use Dawnstar\Api\Contracts\Repositories\MediaRepository;
use Dawnstar\Api\Contracts\Repositories\MenuRepository;
use Dawnstar\Api\Contracts\Repositories\PageRepository;

class MenuContentResource extends ResponseResource
{
    public function collectionToArray($menuContents): array
    {
        $array = [];
        foreach ($menuContents as $menuContent) {
            $array[] = $this->singleToArray($menuContent);
        }

        return $array;
    }

    public function singleToArray($menuContent): array
    {
        $array = [
            'id' => $menuContent->id,
            'name' => strip_tags($menuContent->name),
            'type' => $this->getMenuContentType($menuContent->type),
            'url' => $this->getMenuContentUrl($menuContent),
            'target' => $menuContent->target
        ];

        $children = (new MenuRepository())->getContentChildren($menuContent);
        if($children->isNotEmpty()) {
            $array['children'] = $this->collectionToArray($children);
        }

        return $array;
    }

    private function getMenuContentType($type)
    {
        switch ($type) {
            case 1:
                return 'inner_link';
            case 2:
                return 'outer_link';
            default:
                return 'empty';
        }
    }

    private function getMenuContentUrl($menuContent)
    {
        switch ($menuContent->type) {
            case 1:
                return url($menuContent->url->url);
            case 2:
                return $menuContent->out_link;
            default:
                return '';
        }
    }
}
