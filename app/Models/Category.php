<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    public function sub_categories(): HasMany {
        return $this->hasMany(__CLASS__);
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }

    public function parent_category(): BelongsTo {
        return $this->belongsTo(__CLASS__, 'category_id');
    }
}
