<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class Quotation extends Model
{
    use PreventDemoModeChanges;
}
