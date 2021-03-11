<?php

namespace Dawnstar\Api\Contracts\Interfaces;

interface ContainerInterface
{
    public function getById(int $id);

    public function getAll();

    public function getCategories($container);

    public function getPages($container);
}
