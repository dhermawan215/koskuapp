<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    protected $fillable = [
        'users_id',
        'kontrakan_id',
        'transaction_number',
        'total',
        'room',
        'status',
        'payment_method',
        'payment_picture',
        'payment_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function kontrakan()
    {
        return $this->belongsTo(Kontrakan::class, 'kontrakan_id', 'id');
    }

    public function getPaymentPictureAttribute($paymentPicture)
    {
        return  Storage::url($paymentPicture);
    }
}
