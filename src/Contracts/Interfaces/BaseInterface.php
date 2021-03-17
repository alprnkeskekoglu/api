<?php

namespace Dawnstar\Api\Contracts\Interfaces;

use Illuminate\Http\Request;

interface BaseInterface
{
    public function getAll();

    public function getById(int $id);

    public function store($request);

    public function update(Request $request, $model);

    public function destroy($model);
}
