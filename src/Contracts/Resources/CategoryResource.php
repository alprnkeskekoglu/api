<?php

namespace Dawnstar\Api\Contracts\Resources;

class CategoryResource
{
    public function getCategoriesByRelation($model)
    {
        $array = [];

        $categories = $model->categories()->where('status', 1)->orderBy('lft')->get();
        foreach ($categories as $category) {
            $array[] = [
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
        }

        return $array;
    }
}
