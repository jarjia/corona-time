<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CountryStatistics extends Model
{
    use HasFactory, HasTranslations;


	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	*/
    protected $guarded = [];

    /**
	 * The attributes that are translatable.
	 *
	 * @var array
     */
    public $translatable = ['name'];

    /**
	 * The attributes that are casted as array.
	 *
	 * @var array
	 */
    protected $casts = [
        'name' => 'array'
    ];

    /**
	 * Function for search filtering.
	*/
    public function scopeFilter($query, array $filters, $request)
    {
        $search = $request->query('search');
		$sort = $request->query('column');
        $type = $request->query('direction');
        
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(fn($query) =>
                $query->where("name->en", 'LIKE', "%".strtolower($search)."%")
                ->orWhere("name->ka", 'LIKE', "%".strtolower($search)."%")
            );
		});

        if ($sort) {
            if($sort === 'name') {
                $query->orderBy($sort.'->'.app()->getLocale(), $type);
            }else {
                $query->orderBy($sort, $type);
            }
		}

        return $query;
    }
}
