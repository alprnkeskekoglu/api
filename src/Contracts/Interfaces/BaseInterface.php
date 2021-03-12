<?php

namespace Dawnstar\Api\Contracts\Interfaces;

interface BaseInterface
{
    public function getAll();

    public function getById(int $id);

    public function store($request);

    public function update($model);

    public function destroy($model);
}
