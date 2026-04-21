<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPOS extends Model
{
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'level_id');
    }
}