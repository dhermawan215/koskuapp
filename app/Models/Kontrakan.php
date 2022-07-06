<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Kontrakan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kontrakan';

    protected $fillable = [
        'users_id',
        'name',
        'address',
        'district',
        'regency',
        'facility',
        'price',
        'status',
        'ratings',
        'tags',
        'whatsapp_number',
        'gmap_url',
        'latitude',
        'longtitude',
        'picture'
    ];

    public function galerries()
    {
        return $this->hasMany(Gallery::class, 'kontrakan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function KontrakanTransaction()
    {
        return $this->hasMany(Transaction::class, 'kontrakan_id', 'id');
    }

    public function getPictureAttribute($picture)
    {
        // return  Storage::url($picture);
        return \config('app.url') . Storage::url($picture);
    }
}
