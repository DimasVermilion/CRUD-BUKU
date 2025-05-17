<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    Use HasFactory;

   Protected $fillable = ['title','author','category_id', 'publish_date','page'];

   public function Category() {
        return $this->belongsTo(Category::class);
   }
}
