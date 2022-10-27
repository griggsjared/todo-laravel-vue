<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Dyrynda\Database\Casts\EfficientUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array<string, mixed>
     */
    protected $casts = [
        'is_complete' => 'boolean',
        'uuid' => EfficientUuid::class,
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
