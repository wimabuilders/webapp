<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFirstPropertyImage()
    {
        return !empty($this->media->sortByDesc('order_column')->first()?->getUrl()) ?
            $this->media->sortByDesc('order_column')->first()->getUrl()
            : env('DEFAULT_PROPERTY_IMAGE', 'https://res.cloudinary.com/dwdhm3rrc/image/upload/v1735137428/wimaDefault_vovgpc.jpg');
    }
}
