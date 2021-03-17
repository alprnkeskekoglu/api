<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\ContainerInterface;
use Dawnstar\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ContainerRepository implements ContainerInterface, BaseInterface
{
    public function getAll()
    {
        return Container::where('status', 1)->where('website_id', dawnstar()->website->id)->get();
    }

    public function getById(int $id)
    {
        return Container::find($id);
    }

    public function getCategories($container)
    {
        return $container->categories()->where('status', 1)->orderBy('lft')->get();
    }

    public function getPages($container)
    {
        return $container->pages()->where('status', 1)->orderBy('order')->get();
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update(Request $request, $model)
    {
        $data = $request->except('id', 'access_token');

        foreach ($data as $key => $value) {

            $value = $value ? strip_tags($value) : null;

            if(Schema::hasColumn($model->getTable(), $key)) {
                $model->{$key} = strip_tags($value);
            } elseif(Schema::hasColumn($model->detail->getTable(), $key)) {
                $model->detail->{$key} = strip_tags($value);
            }
        }
        $model->save();
        $model->detail->save();
        return $model;
    }

    public function destroy($model)
    {
        // TODO: Implement destroy() method.
    }
}
