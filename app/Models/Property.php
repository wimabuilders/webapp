<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
