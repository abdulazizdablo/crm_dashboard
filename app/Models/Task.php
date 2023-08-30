<?php

namespace App\Models;

use App\Traits\FormatDates;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Task extends Model implements HasMedia
{
    use HasFactory, FormatDates, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'deadline',
        'client_id',
        'project_id',
        'status'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /*public function setDeadLineAttribute(){


        $this->attributes['deadline'] = Carbon::parse()
    }*/
}
