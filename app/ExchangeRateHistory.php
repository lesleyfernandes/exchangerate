<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRateHistory extends Model
{
    protected $fillable = ['birthday','currency','rate','timeschecked'];    
}
