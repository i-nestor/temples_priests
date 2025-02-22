<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temple extends Model {

    use HasFactory;

    protected $fillable = ["name", "shortname", "slug", "user_id", "image", "description"];

    public function scopeFilter($query, array $filters): void { /* добавил void */
        $query->when($filters['search'] ?? false,
            fn ($query, $search) =>
                $query->where("shortname", "like", '%' . $search . '%')
                      ->orWhere("name", "like", '%' . $search . '%')
        );

        $query->when($filters['abc'] ?? false,
            fn ($query, $abc) =>
                $query->where("shortname", "like", $abc . '%')
        );
    }

    public function author(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    // для привязки маршрута со слагом(slug) вместо идентификатора(id)
    public function getRouteKeyName(): string {
        return 'slug';
    }
}
