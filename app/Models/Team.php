<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
    use HasFactory;

    protected $table = "teams";

    protected $fillable = [
        "teamName",
        "teamAdvocacy",
        "election_id"
    ];

    public function elections(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }
}