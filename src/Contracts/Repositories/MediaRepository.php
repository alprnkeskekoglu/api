<?php

namespace Dawnstar\Api\Contracts\Repositories;

use Dawnstar\Api\Contracts\Interfaces\BaseInterface;
use Dawnstar\Api\Contracts\Interfaces\MediaInterface;
use Dawnstar\FileManager\Models\Media;
use Illuminate\Http\Request;

class MediaRepository implements MediaInterface, BaseInterface
{
    public function getAll()
    {
        return Media::where('uploaded_place', 'panel')->get();
    }

    public function getById(int $id)
    {
        return Media::find($id);
    }

    public function getByModel($model)
    {
        return $model->medias;
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update(Request $request, $model)
    {
        // TODO: Implement update() method.
    }

    public function destroy($model)
    {
        // TODO: Implement destroy() method.
    }
}
