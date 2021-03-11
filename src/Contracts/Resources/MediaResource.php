<?php

namespace Dawnstar\Api\Contracts\Resources;

class MediaResource
{
    public function getMediasByRelation($model)
    {
        $array = [];

        $medias = $model->mc_;
        foreach ($medias as $media) {
            $array[] = media($media->id);
        }

        return $array;
    }
}
