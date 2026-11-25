<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    /** @use HasFactory<\Database\Factories\DestinationFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * @return HasMany<DestinationSection, $this>
     */
    public function sections(): HasMany
    {
        return $this->hasMany(DestinationSection::class)->orderBy('sort_order');
    }
}
