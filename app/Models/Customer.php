<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email','activity','phone','vat','address','zipcode','city','notes','category_id','source_id'];

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function source()
    {
         return $this->belongsTo(Source::class);

    }

    public function category()
    {
         return $this->belongsTo(CustomerCategory::class);

    }

}
