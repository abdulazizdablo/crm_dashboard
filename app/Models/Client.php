<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Client extends Model
{
    use HasFactory;

    protected $fillable = [

        'company',
        'vat',
        'address'
    ];


    /* public function clientActiveScope()
    {

        return Client::where('status', 1);
    }*/




    public function projects(): HasMany
    {

        return $this->hasMany(Project::class);
    }
}
