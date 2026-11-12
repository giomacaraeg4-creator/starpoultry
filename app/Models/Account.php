<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $primaryKey = 'id';

    
    protected $fillable = [
        'user_name',
        'password_hash',
        'role',
        'status',
        'approval_status',
    ];


    protected $hidden = [
        'password_hash',
    ];

    public $timestamps = true;
}
