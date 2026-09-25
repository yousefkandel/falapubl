<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Translator extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'bio_ar',
        'bio_en',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // علاقة مع الكتب
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    // سكوب البحث
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;

        return $query->where(function($q) use ($term) {
            $q->where('name_ar', 'like', "%{$term}%")
              ->orWhere('name_en', 'like', "%{$term}%")
              ->orWhere('bio_ar', 'like', "%{$term}%")
              ->orWhere('bio_en', 'like', "%{$term}%");
        });
    }

    // سكوب الحالة
    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    // Accessor للحصول على الصورة أو الصورة الافتراضية
    public function getAvatarAttribute(): string
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/default-avatar.svg');
    }
}
