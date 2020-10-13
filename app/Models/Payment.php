<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['sum', 'user_id', 'payer_name', 'payment_system'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
