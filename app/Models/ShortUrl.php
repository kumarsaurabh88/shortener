<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ShortUrl extends Model
{
    protected $fillable = ['short_code', 'original_url', 'company_id', 'created_by'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->short_code) {
                $model->short_code = Str::random(6);
            }
        });
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getShortUrlAttribute(): string
    {
        return config('app.url') . '/s/' . $this->short_code;
    }
}
