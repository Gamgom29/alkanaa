<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class Company extends Model
{
    use PreventDemoModeChanges;

    protected $fillable = [
        'company_name','tax_number','commercial_register','created_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
