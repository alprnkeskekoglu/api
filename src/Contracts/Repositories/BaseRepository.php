<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\CategoryInterface;
use Dawnstar\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BaseRepository
{

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
        $model->delete();
    }
}
