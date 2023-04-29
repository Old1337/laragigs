<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

//Eloquent RelationShips
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description', 'logo'];

    public function scopeFilter($query)
    {

        $this->filterBy($query, 'tags', request('tag'));
        $this->filterBy($query, 'title', request('search'));
    }

    public function filterBy($query, $column, $filter)
    {
        if ($filter) {
            $query->where($column, 'LIKE', '%' . $filter . '%');


            Session::flash('tag', request('tag'));
            Session::flash('search', request('search'));
        }
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
