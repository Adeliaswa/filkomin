<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'app_name','timezone','locale','date_format','logo_path','updated_by'
    ];
}
