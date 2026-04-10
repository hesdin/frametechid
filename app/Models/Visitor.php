<?php

namespace App\Models;

use Database\Factories\VisitorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /** @use HasFactory<VisitorFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'visitor_token',
        'first_visited_at',
        'last_visited_at',
        'last_path',
        'last_ip',
        'user_agent',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'first_visited_at' => 'datetime',
            'last_visited_at' => 'datetime',
        ];
    }
}
