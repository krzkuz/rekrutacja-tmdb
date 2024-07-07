<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Genre extends Model
{
    use HasFactory;


    protected $fillable = [
        'tmdb_id',
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }

    public function series(): BelongsToMany
    {
        return $this->belongsToMany(Serie::class);
    }

    public function translates(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}
