<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function fields()
    {
      return $this->belongsToMany(Field::class, 'biography_field');
    }

    public function generation()
    {
      return $this->belongsTo(Generation::class);
    }
}
