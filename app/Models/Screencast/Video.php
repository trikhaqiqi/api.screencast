<?php

namespace App\Models\Screencast;

use App\Models\Screencast\Playlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'unique_video_id', 'runtime', 'episode', 'intro'];

    // public function toArray() 
    // {
    //     return [
    //         'created_at' => $this->created_at->format("d F, Y"),
    //     ];
    // }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
