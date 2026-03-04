<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'interview_date',
        'type',
        'feedback',
        'passed'
    ];

    protected $casts = [
        'passed' => 'boolean',
        'interview_date' => 'date',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
