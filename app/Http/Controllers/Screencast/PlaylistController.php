<?php

namespace App\Http\Controllers\Screencast;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Screencast\Tag;
use App\Models\Screencast\Playlist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Screencast\PlaylistResource;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('user')->withCount('videos')->latest()->paginate(9);
        return PlaylistResource::collection($playlists);
    }

    public function show(Playlist $playlist)
    {
        return new PlaylistResource($playlist);
    }

    public function create()
    {
        return view('playlists.create', [
            'playlist' => new Playlist(),
            'tags' => Tag::get(),
        ]);
    }

    public function store(PlaylistRequest $request)
    {
        $playlist = Auth::user()->playlists()->create([
            'name' => $request->name,
            'thumbnail' => $request->file('thumbnail')->store('images/playlist'),
            'slug' => Str::slug($request->name . '-' . Str::random(6)),
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $playlist->tags()->sync(request('tags'));

        return back();
    }

    public function table()
    {
        $playlists = Auth::user()->playlists()->latest()->paginate(16);
        return view('playlists.table', compact('playlists'));
    }

    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        return view('playlists.edit', [
            'playlist' => $playlist,
            'tags' => Tag::get(),
        ]);
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        if ($request -> thumbnail) {
            Storage::delete($playlist->thumbnail);
            $thumbnail = $request->file('thumbnail')->store('images/playlist');
        } else {
            $thumbnail = $playlist->thumbnail;
        }

        $playlist->update([
            'name' => $request->name,
            'thumbnail' => $thumbnail,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $playlist->tags()->sync(request('tags'));

        return redirect(route('playlists.table'));
    }

    public function destroy(Playlist $playlist)
    {
        $this->authorize('delete', $playlist);

        Storage::delete($playlist->thumbnail);
        $playlist->tags()->detach();
        $playlist->delete();

        return redirect(route('playlists.table'));
    }
}
