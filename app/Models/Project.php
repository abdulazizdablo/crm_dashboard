<?php

namespace App\Models;

use App\Traits\FormatDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,FormatDates,SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status'
    ];
}
