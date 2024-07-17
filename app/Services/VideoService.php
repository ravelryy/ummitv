<?php

namespace App\Services;

use App\Models\User;
use App\Models\Video;

class VideoService
{
    public function createVideo(array $data)
    {
        if($data['uploaded_by']) {
            if(isset($data['thumbnail'])) {
            $video = Video::create($data);
            // $video->attachTags($data['tags']); Kalo perlu tags
            $video->addMedia($data['thumbnail']->getRealPath())->usingFileName($data['thumbnail']->getClientOriginalName())->toMediaCollection('videos');

            return $video;
            } else {
                return 'Error: No thumbnail provided.';
            }
        } else {
            return 'Error: User not found.';
        }
    }

    public function updateVideo(Video $video, User $user, array $data)
    {
        if($video->uploader == $user ) {
            if(isset($data['thumbnail'])) {
                $video->update($data);
                $video->clearMediaCollection('videos');
                $video->addMedia($data['thumbnail']->getRealPath())->usingFileName($data['thumbnail']->getClientOriginalName())->toMediaCollection('videos');

                return $video;
            } else {
                return $video->update($data);
            }
        } else {
            return 'Error: User not allowed to edit video.';
        }
    }
}
