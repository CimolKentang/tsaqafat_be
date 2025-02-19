<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;

    protected $guarded = [
      'id'
    ];

    public function biographies()
    {
      return $this->hasMany(Biography::class);
    }
}
