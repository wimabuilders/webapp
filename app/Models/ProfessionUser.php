<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProfessionUser extends Model implements HasMedia
{
    use InteractsWithMedia, HasUuids;

    protected $guarded = [];

    protected $table = 'profession_user';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function getCertAttribute()
    {
        return $this->getFirstMediaUrl('certs');
    }
}
