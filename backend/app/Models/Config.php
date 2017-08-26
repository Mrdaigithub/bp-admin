<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {
    protected $table = 'configs';
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
