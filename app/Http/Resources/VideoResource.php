<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray(Request $request)
    {
        $thumbnail = $this->getFirstMediaUrl('videos');
        $videoId = $this->extractVideoId($this->path);
        // $tags = $this->tags->pluck('name')->toArray();

        return [
            'id' => $this->id,
            'path' => $this->path,
            'videoId' => $videoId,
            'title' => $this->title,
            'slug' => $this->slug,
            'uploaded_by' => new UserResource($this->uploader),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'thumbnail' => $thumbnail,
            // 'tags' => $tags,
        ];
    }

    private function extractVideoId($url)
    {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=))([^#\&\?]*)(?:\S+)?/';
        preg_match($pattern, $url, $matches);

        return isset($matches[1])? $matches[1] : null;
    }

}
