<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CountryStatistics extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['name'];

    protected $casts = [
        'name' => 'array'
    ];

    public function scopeFilter($query, array $filters)
    {
        $locale = app()->getLocale();
        
        $query->when($filters['search'] ?? false, function ($query, $search) use ($locale) {
            return $query->where(fn($query) => 
                $query->where("name->{$locale}", 'like', '%' . $search . '%')
            );
        });
    }
}
