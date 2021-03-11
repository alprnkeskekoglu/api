<?php

namespace Dawnstar\Api\Contracts\Resources;


class ContainerResource
{
    public function collectionToArray($containers)
    {
        $array = [];
        $categoryStatus = request('category') == 1;
        $pageStatus = request('page') == 1;

        foreach ($containers as $container) {
            $temp = [
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

            if($container->mc_->isNotEmpty()) {
                $temp['medias'] = (new MediaResource())->getMediasByRelation($container);
            }

            if($categoryStatus && $container->has_category == 1) {
                $temp['categories'] = (new CategoryResource())->getCategoriesByRelation($container);
            }

            if($pageStatus && $container->type == 'dynamic') {
                $temp['pages'] = (new PageResource())->getPagesByRelation($container);
            }

            $array[] = $temp;
        }

        return $array;
    }
}
