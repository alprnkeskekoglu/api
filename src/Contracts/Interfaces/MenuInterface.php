<?php

namespace Dawnstar\Api\Contracts\Interfaces;

interface MenuInterface
{
    public function getContents($menu);

    public function getContentChildren($menuContent);
}
