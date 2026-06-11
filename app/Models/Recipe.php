<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'spoonacular_id',
        'title',
        'image',
        'summary',
        'instructions',
        'ready_in_minutes',
        'servings',
        'calories',
        'dish_types',
        'diets',
        'ingredients',
        'protein',
        'protein_unit',
        'fat',
        'fat_unit',
        'embedding',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dish_types' => 'array',
            'diets' => 'array',
            'ingredients' => 'array',
            'embedding' => 'array',
            'protein' => 'decimal:2',
            'fat' => 'decimal:2',
        ];
    }

    public function savedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_recipes')->withTimestamps();
    }
}
