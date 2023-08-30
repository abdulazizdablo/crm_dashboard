<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_name',
        'contact_email',
        'company_city',
        'contact_phone_number',
        'company_zip',
        'company_name',
        'company_vat',
        'company_address'
    ];


   
    public function projects(): HasMany
    {

        return $this->hasMany(Project::class);
    }

    public function getFullNameAttribute()
    {

        return $this->first_name . ' ' . $this->last_name;
    }

    public function tasks(): HasMany
    {

        return $this->hasMany(Task::class);
    }
}
