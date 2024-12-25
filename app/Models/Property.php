<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use HasFactory, HasUuids, InteractsWithMedia, SoftDeletes;

    protected $guarded = [];

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Register the media collections
     * To be optimized later. Not sure why getFirstMediaUrl() is retrieving the last media instead of the first
     */
    public function getFirstPropertyImage()
    {
        return !empty($this->media->sortByDesc('order_column')->first()?->getUrl()) ?
            $this->media->sortByDesc('order_column')->first()->getUrl()
            : env('DEFAULT_PROPERTY_IMAGE', 'https://res.cloudinary.com/dwdhm3rrc/image/upload/v1735137428/wimaDefault_vovgpc.jpg');
    }
}
