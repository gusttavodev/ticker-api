<?php

namespace App\Models;

use App\Models\Prize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'numbers',
        'code',
        'winner',
        'created_at',
    ];

    protected $casts = [
        'numbers' => 'array',
        'winner' => 'boolean'
    ];

    public function prize(): BelongsTo
    {
        return $this->belongsTo(Prize::class);
    }
}
