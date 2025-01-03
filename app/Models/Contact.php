<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'email', 'phone', 'mobile', 'position', 'contactable_id', 'contactable_type'];

    public function contactable()
    {
        return $this->morphTo();
    }
}
