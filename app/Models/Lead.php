<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['name', 'email','activity','phone','vat','address','zipcode','city','notes','category_id','source_id'];

    public function source()
    {
         return $this->belongsTo(Source::class);

    }

    public function category()
    {
         return $this->belongsTo(CustomerCategory::class);

    }
}
