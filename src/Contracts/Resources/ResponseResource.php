<?php

namespace Dawnstar\Api\Contracts\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class ResponseResource
{
    abstract public function collectionToArray($models): array;

    abstract public function singleToArray($model): array;
}
