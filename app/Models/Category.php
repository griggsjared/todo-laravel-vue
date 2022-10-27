<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Dyrynda\Database\Casts\EfficientUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
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
        'uuid' => EfficientUuid::class,
    ];

    /**
     * @return HasMany
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
}
