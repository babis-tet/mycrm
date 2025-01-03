<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email','activity','phone','vat','address','zipcode','city','notes'];

    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }
}
