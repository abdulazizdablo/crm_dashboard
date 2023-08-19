<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


use Illuminate\Database\Eloquent\Casts\Attribute;

trait FormatDates
{

    protected function deadLineFormat(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('m-d-Y'),

        );
    }
    public function getdeadLineFormatChanged()
    {
        return $this->get('deadline');
    }
}
