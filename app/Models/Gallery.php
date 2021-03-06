<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'kontrakan_id',
        'picture_galleries',
    ];

    public function kontrakan()
    {
        return $this->belongsTo(Kontrakan::class, 'kontrakan_id', 'id');
    }

    public function getPictureAttribute($pictureGalleries)
    {
        // return  Storage::url($picture);
        return \config('app.url') . Storage::url($pictureGalleries);
    }
}
