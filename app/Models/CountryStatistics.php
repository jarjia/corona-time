<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryStatistics extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function countryCodes()
    {
        return $this->belongsTo(CountryCodes::class, 'code', 'code');
    }
}
