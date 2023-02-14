<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'ward';
    protected $fillable = [
        'uniqueid',
        'ward_id',
        'ward_name',
        'lga_id',
        'ward_description',
        'entered_by_user',
        'date_entered',
        'user_ip_address'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
