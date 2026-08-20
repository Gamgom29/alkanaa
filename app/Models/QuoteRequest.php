<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class QuoteRequest extends Model
{
    use PreventDemoModeChanges;

    protected $table = 'quote_requests';

        protected $fillable = [
        'invoice_file',
        'problem_desc'
    ];
}
