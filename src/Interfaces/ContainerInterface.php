<?php

namespace Dawnstar\Api\Interfaces;

interface ContainerInterface
{
    public function getAll();

    public function getById(int $id);
}
