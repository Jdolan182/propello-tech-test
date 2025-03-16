<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property boolean $complete
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'complete'
    ];

    protected $casts = [
        'complete' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        $this->belongsTo(User::class);
    }

    
    public function tags(): BelongsToMany
    {
        return $this->BelongsToMany(Tags::class, 'tags_task');
    }
}
