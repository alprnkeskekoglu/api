<?php

namespace Dawnstar\Api\Contracts\Resources\Output;

abstract class BaseOutput
{
    abstract public function output(array $data);
}
