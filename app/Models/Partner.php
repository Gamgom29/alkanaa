<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

use App;

class Partner extends Model
{
    use PreventDemoModeChanges;

    protected $fillable = ['name', 'logo', 'meta_title', 'meta_description'];

}
