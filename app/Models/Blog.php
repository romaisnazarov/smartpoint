<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'resource_id',
        'external_id',
        'name',
        'rating',
        'cat_name',
        'author',
        'monitoring_frequency'
    ];

    /**
     * @return BelongsTo
     */
    public function resource(): BelongsTo
    {
        return $this->belongsTo(Resource::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
