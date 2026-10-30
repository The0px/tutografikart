<?php

namespace App\Models;

use Database\Factories\PropertyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Property extends Model
{
    /** @use HasFactory<PropertyFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold',
    ];

    protected $casts = [
        'sold' => 'boolean',
    ];

    public function publish()
    {
        Publisher::publish();
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function getSlug(): string
    {

        return Str::slug($this->title);

    }

    public function scopeAvailable(Builder $builder, bool $available = true): Builder
    {

        return $builder->where('sold', ! $available);
    }

    public function scopeRecent(Builder $builder): Builder
    {
        return $builder->orderBy('created_at', 'desc');
    }
}
