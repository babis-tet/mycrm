<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Document extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use LogsActivity;

    protected $fillable = ['name', 'documentable_type', 'documentable_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name']) // Specify attributes to log
            ->logOnlyDirty(); // Log only changed attributes
            //->useLogName('user_actions'); // Set a custom log name
    }

    public function documentable()
    {
        return $this->morphTo();
    }
}
