<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Election extends Model
{
    use HasFactory;

    protected $table = "elections";
    protected $fillable = [
        'electionName',
        'startAt',
        'endAt'
    ];

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
