<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function biographies()
    {
      return $this->belongsToMany(Biography::class, 'biography_field');
    }
}
