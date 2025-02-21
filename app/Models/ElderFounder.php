<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElderFounder extends Model {
    use HasFactory;

    protected $fillable = ["firstname", "secondname", "slug", "user_id", "image", "biography"];

    public function scopeFilter($query, array $filters): void {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where("secondname", "like", '%' . $search . '%')
                ->orWhere("firstname", "like", '%' . $search . '%')
        );
        $query->when($filters['abc'] ?? false,
            fn ($query, $abc) =>
            $query->where("secondname", "like", $abc . '%')
        );
    }

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName(): string {
        return 'slug';
    }
}
