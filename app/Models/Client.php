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
        'first_name',
        'last_name',
        'company',
        'vat',
        'address'
    ];


    /* public function clientActiveScope()
    {

        return Client::where('status', 1);
    }*/


    public function scopeActiveFromSession(Builder $query)
    {
        // Get the user's session ID
        $sessionId = session('session_id');
    
        // Get the active clients from the session database
        $clients = DB::table('sessions')
            ->where('id', $sessionId)
            ->where('last_activity', '>', Carbon::now()->subMinutes(15))
            ->pluck('client_id');
    
        // Only return the clients that are in the session database
        $query->whereIn('id', $clients);
    }

    public function projects(): HasMany
    {

        return $this->hasMany(Project::class);
    }

    public function getFullName(){

        return $this->first_name .' '. $this->last_name;
    }
}
