<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tags extends Model
{
    use HasFactory;

    protected $fillable  = [
        'name',
        'user_id',
    ];

    public function tasks(): BelongsToMany
    {
        return $this->BelongsToMany(Task::class, 'tags_task');
    }
}
