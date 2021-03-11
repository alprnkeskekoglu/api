<?php

namespace Dawnstar\Api\Contracts\Interfaces;

interface BaseInterface
{
    public function store($request);

    public function update($model);

    public function destroy($model);
}
