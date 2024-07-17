<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Services\VideoService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\VideoResource;
use App\Http\Requests\StoreVideoRequest;

class VideoController extends Controller
{
    protected $videoService;
    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::all();
        return VideoResource::collection($videos);
    }

    public function create()
    {
        $user = Auth::user();
        return view('videos.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoRequest $request)
    {
        $video = $this->videoService->createVideo($request->validated());

        // check if the video successfully saved
        if($video) {
            return new VideoResource($video);
        } else {
            // return error if video not saved
            return response()->json(['error' => 'Failed to create video'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $video = Video::where('slug', $slug)->first();
        $relatedVideos = Video::where('id', '!=', $video->id)->get();
        return response()->json(['video' => new VideoResource($video), 'relatedVideos' => VideoResource::collection($relatedVideos)]);
    }

    public function edit(Video $video)
    {
        $video = Video::findOrFail($video);
        $user = Auth::user();

        return view('videos.update', compact('video', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $user = Auth::user()->id;
        $video = Video::findOrFail($video);
        $updatedVideo = $this->videoService->updateVideo($video, $user, $request->validated());

        return response()->json(new VideoResource($updatedVideo));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
