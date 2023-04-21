<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CountryCodes extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'code'];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'array'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('name', 'like', '%' . $search . '%')
            )
        );
    }

    public function statistics()
    {
        return $this->hasOne(CountryStatistics::class, 'code');
    }
}
