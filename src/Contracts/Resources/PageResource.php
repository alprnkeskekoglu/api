<?php

namespace Dawnstar\Api\Contracts\Resources;

use Dawnstar\Api\Contracts\Repositories\CategoryRepository;
use Dawnstar\Api\Contracts\Repositories\ContainerRepository;
use Dawnstar\Api\Contracts\Repositories\MediaRepository;
use Dawnstar\Api\Contracts\Repositories\PageRepository;
use Dawnstar\Api\Contracts\Resources\ResponseResource;

class PageResource extends ResponseResource
{
    public function collectionToArray($pages): array
    {
        $array = [];
        foreach ($pages as $page) {
            $array[] = $this->singleToArray($page);
        }

        return $array;
    }

    public function singleToArray($page): array
    {
        $containerStatus = request('pageContainer') == 1;
        $categoryStatus = request('pageCategory') == 1;

        $array = [
            'id' => $page->id,
            'name' => strip_tags($page->detail->name),
            'detail' => strip_tags($page->detail->detail),
            'order' => $page->order,
            'date' => $page->date,
            'cvar_1' => $page->cvar_1,
            'cvar_2' => $page->cvar_2,
            'cint_1' => $page->cint_1,
            'cint_2' => $page->cint_2,
            'ctext_1' => $page->ctext_1,
            'ctext_2' => $page->ctext_2
        ];

        $medias = (new MediaRepository())->getByModel($page);
        if($medias->isNotEmpty()) {
            $array['medias'] = (new MediaResource())->collectionToArray($medias);
        }

        if($containerStatus) {
            $container = (new ContainerRepository())->getById($page->container_id);
            $array['container'] = (new ContainerResource())->singleToArray($container);
        }

        if($categoryStatus) {
            $categories = (new PageRepository())->getCategories($page);
            $array['categories'] = (new CategoryResource())->collectionToArray($categories);
        }

        return $array;
    }
}
