<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Services\UploadService;
use App\Traits\WithCurrencyFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wine extends Model
{
    use HasFactory;
    use HasSlug;
    use WithCurrencyFormatter;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'year',
        'price',
        'stock',
        'image',
    ];

    public function casts(): array
    {
        return [
            'year' => 'integer',
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => UploadService::url($this->image),
        );
    }

    public function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->formatCurrency($this->price),
        );
    }
}
