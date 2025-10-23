<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    protected $table = 'activity_log';

    protected $fillable = [
        'log_name',
        'Description',
        'subject_type',
        'event',
        'subject_id',
        'causer_type',
        'properties',
        'batch_uuid'
    ];
}
