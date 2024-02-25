<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function queries()
    {
        return $this->belongsToMany(Query::class);
    }
}
