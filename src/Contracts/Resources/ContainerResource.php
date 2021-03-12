<?php

namespace Dawnstar\Api\Contracts\Resources;


use Dawnstar\Api\Contracts\Repositories\ContainerRepository;
use Dawnstar\Api\Contracts\Repositories\MediaRepository;
use Dawnstar\Api\Contracts\Resources\ResponseResource;

class ContainerResource extends ResponseResource
{
    public function collectionToArray($containers): array
    {
        $array = [];

        foreach ($containers as $container) {
            $array[] = $this->singleToArray($container);
        }

        return $array;
    }

    public function singleToArray($container): array
    {
        $categoryStatus = request('containerCategory') == 1;
        $pageStatus = request('containerPage') == 1;

        $array = [
            'id' => $container->id,
            'name' => strip_tags($container->detail->name),
            'detail' => strip_tags($container->detail->detail) ?: null,
            'cvar_1' => $container->cvar_1,
            'cvar_2' => $container->cvar_2,
            'cint_1' => $container->cint_1,
            'cint_2' => $container->cint_2,
            'ctext_1' => $container->ctext_1,
            'ctext_2' => $container->ctext_2,
        ];

        $medias = (new MediaRepository())->getByModel($container);
        if($medias->isNotEmpty()) {
            $array['medias'] = (new MediaResource())->collectionToArray($medias);
        }

        if($categoryStatus && $container->has_category == 1) {
            $categories = (new ContainerRepository())->getCategories($container);
            $array['categories'] = (new CategoryResource())->collectionToArray($categories);
        }

        if($pageStatus && $container->type == 'dynamic') {
            $pages = (new ContainerRepository())->getPages($container);
            $array['pages'] = (new PageResource())->collectionToArray($pages);
        }

        return $array;
    }

}
