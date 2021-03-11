<?php

namespace Dawnstar\Api\Contracts\Resources;

class PageResource
{
    public function getPagesByRelation($model)
    {
        $array = [];

        $pages = $model->pages()->where('status', 1)->orderBy('order')->get();
        foreach ($pages as $page) {
            $temp = [
                'id' => $page->id,
                'name' => strip_tags($page->detail->name),
                'detail' => strip_tags($page->detail->detail),
                'date' => $page->date,
                'cvar_1' => $page->cvar_1,
                'cvar_2' => $page->cvar_2,
                'cint_1' => $page->cint_1,
                'cint_2' => $page->cint_2,
                'ctext_1' => $page->ctext_1,
                'ctext_2' => $page->ctext_2
            ];

            if($page->mc_->isNotEmpty()) {
                $temp['medias'] = (new MediaResource())->getMediasByRelation($page);
            }

            $array[] = $temp;
        }

        return $array;
    }
}
