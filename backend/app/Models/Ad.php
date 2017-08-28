<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';
    protected $hidden = ['created_at', 'updated_at'];
}
