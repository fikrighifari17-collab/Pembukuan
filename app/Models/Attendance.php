<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = ['employee_id', 'date', 'status', 'overtime_hours', 'check_in_time', 'check_out_time', 'image_path', 'latitude', 'longitude'];

    protected $casts = [
        'date' => 'date',
        'overtime_hours' => 'integer',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
