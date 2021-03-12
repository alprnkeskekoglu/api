<?php

namespace Dawnstar\Api\Contracts\Resources;

use Dawnstar\Api\Contracts\Repositories\CategoryRepository;
use Dawnstar\Api\Contracts\Repositories\ContainerRepository;
use Dawnstar\Api\Contracts\Repositories\MediaRepository;
use Dawnstar\Models\Category;
use Illuminate\Support\Collection;

class CategoryResource extends ResponseResource
{
    /**
     * @param Collection $categories
     * @return array
     */
    public function collectionToArray($categories): array
    {
        $array = [];

        foreach ($categories as $category) {
            $temp = $this->singleToArray($category);

            $array[] = $temp;
        }

        return $array;
    }

    /**
     * @param $category
     * @return array
     */
    public function singleToArray($category): array
    {
        $containerStatus = request('categoryContainer') == 1;
        $pageStatus = request('categoryPage') == 1;

        $array = [
            'id' => $category->id,
            'name' => strip_tags($category->detail->name),
            'detail' => strip_tags($category->detail->detail),
            'cvar_1' => $category->cvar_1,
            'cvar_2' => $category->cvar_2,
            'cint_1' => $category->cint_1,
            'cint_2' => $category->cint_2,
            'ctext_1' => $category->ctext_1,
            'ctext_2' => $category->ctext_2
        ];

        $medias = (new MediaRepository())->getByModel($category);
        if($medias->isNotEmpty()) {
            $array['medias'] = (new MediaResource())->collectionToArray($medias);
        }

        if($containerStatus) {
            $container = (new ContainerRepository())->getById($category->container_id);
            $array['container'] = (new ContainerResource())->singleToArray($container);
        }

        if($pageStatus) {
            $pages = (new CategoryRepository())->getPages($category);
            $array['pages'] = (new PageResource())->collectionToArray($pages);
        }

        return $array;
    }
}
