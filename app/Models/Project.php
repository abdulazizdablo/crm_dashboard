<?php

namespace App\Models;

use App\Traits\FormatDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Project extends Model implements HasMedia
{
    use HasFactory,FormatDates,SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'user_id',
        'client_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
