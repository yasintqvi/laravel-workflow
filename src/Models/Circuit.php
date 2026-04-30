<?php

namespace Maestrodimateo\Workflow\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maestrodimateo\Workflow\Traits\HasRoles;
use Override;

/**
 * @property-read string $id
 * @property string $name
 * @property string $targetModel
 * @property string $description
 * @property array $roles
 * @property-read HasMany<Basket> $baskets
 *
 * @method static Builder forRole(string $role)
 * @method static Builder forRoles(array $roles)
 */
class Circuit extends Model
{
    use HasRoles, HasUuids;

    protected $fillable = [
        'name',
        'targetModel',
        'description',
        'roles',
    ];

    protected $casts = [
        'roles' => 'array',
    ];

    #[Override]
    protected static function boot(): void
    {
        parent::boot();

        static::created(static function (Circuit $circuit): void {
            $circuit->baskets()->create(Basket::DEFAULT_STATUS);
        });
    }

    /**
     * Get the baskets
     */
    public function baskets(): HasMany
    {
        return $this->hasMany(Basket::class);
    }

    /**
     * Get the messages
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

}
