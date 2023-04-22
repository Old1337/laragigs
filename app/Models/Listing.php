<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Listing extends Model
{
    use HasFactory;


    public function scopeFilter($query)
    {

        $this->filterBy($query, 'tags', request('tag'));
        $this->filterBy($query, 'title', request('search'));
    }

    public function filterBy($query, $column, $filter)
    {
        if ($filter) {
            $query->where($column, 'LIKE', '%' . $filter . '%');
        }
    }
}
