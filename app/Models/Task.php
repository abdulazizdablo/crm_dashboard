<?php

namespace App\Models;

use App\Traits\FormatDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, FormatDates, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'deadline',
        'status'
    ];


    public function project(): BelongsTo
    {


        return $this->belongsTo(Project::class);
    }
}
