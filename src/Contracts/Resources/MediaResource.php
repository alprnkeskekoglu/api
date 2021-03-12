<?php

namespace Dawnstar\Api\Contracts\Resources;

class MediaResource extends ResponseResource
{
    public function collectionToArray($medias): array
    {
        $array = [];

        foreach ($medias as $media) {
            $array[$media->pivot->media_key] = $this->singleToArray($media);
        }

        return $array;
    }

    public function singleToArray($media): array
    {
        $media = media($media->id);
        return [
            'id' => $media->id,
            'fullname' => $media->fullname,
            'extension' => $media->extension,
            'filename' => $media->filename,
            'url' => $media->url,
            'size' => $media->size
        ];
    }
}
