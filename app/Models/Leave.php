<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = ['staff_id', 'leave_type', 'start_date', 'end_date', 'total_days'];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}