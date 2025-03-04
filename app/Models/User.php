<?php

namespace App\Models;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasDefaultTenant, HasTenants, FilamentUser
{
    use HasApiTokens;
    use HasConnectedAccounts;
    use HasRoles;
    use HasFactory;
    use HasProfilePhoto {
        HasProfilePhoto::profilePhotoUrl as getPhotoUrl;
    }
    use Notifiable;
    use SetsProfilePhotoFromUrl;
    use TwoFactorAuthenticatable;
    use HasTeams;

    public function canAccessPanel(Panel $panel): bool
    {
        $user = auth()->user();
        if ($panel->getId() === "admin" && !$user->hasRole('admin')) {
            return false;
        }

        return true; // TODO: Check panel and role
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phonenumber',
        'user_type',
        'parent_id',
        'country_id',
        'city_id',
        'rank_id',
        'active',
        'address',
        'profile_photo_path',
        'referral_number_1',
        'referral_number_2',
        'direction',
        'rank_team_id',
        'code_q',
        'identify_id',
    ];

    public function salaryRank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_id')->where('type', 'salary');
    }

    public function teamRank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_team_id');
    }

    public const USER_TYPE_CUSTOMER = 'customer';
    public const USER_TYPE_ADMIN = 'admin';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Get the URL to the user's profile photo.
     */
    public function profilePhotoUrl(): Attribute
    {
        return filter_var($this->profile_photo_path, FILTER_VALIDATE_URL)
            ? Attribute::get(fn() => $this->profile_photo_path)
            : $this->getPhotoUrl();
    }

    /**
     * @return array<Model> | Collection
     */
    public function getTenants(Panel $panel): array|Collection
    {
        return $this->ownedTeams;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }

    public function canAccessFilament(): bool
    {
        //        return $this->hasVerifiedEmail();
        return true;
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->latestTeam;
    }

    public function latestTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'current_team_id');
    }

    public function browsingHistory(): HasMany
    {
        return $this->hasMany(BrowsingHistory::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function membership(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withPivot(['role']);
    }

    /**
     * Relationship with BVHistory.
     */
    public function bvHistory()
    {
        return $this->hasMany(BVHistory::class);
    }
    public function rspHistory()
    {
        return $this->hasMany(RSPHistory::class);
    }

    public function currentBV(): Attribute
    {
        return Attribute::get(function () {
            return $this->bvHistory
                // ->where('direction', 'R')
                ->sum(function ($bvEntry) {
                    return $bvEntry->bv_value;
                });
        });
    }
    public function currentRightBV(): Attribute
    {
        return Attribute::get(function () {
            return $this->bvHistory
                ->where('direction', BVHistory::DIRECTION_IN)
                ->sum(function ($bvEntry) {
                    return $bvEntry->bv_value;
                });
        });
    }

    public function currentLeftBV(): Attribute
    {
        return Attribute::get(function () {
            return $this->bvHistory
                ->where('direction', BVHistory::DIRECTION_OUT)
                ->sum(function ($bvEntry) {
                    return $bvEntry->bv_value;
                });
        });
    }
    public function currentRSP(): Attribute
    {
        return Attribute::get(function () {
            return $this->rspHistory->sum(function ($rspEntry) {
                return $rspEntry->rsp_value;
            });
        });
    }


    // Define the parent-child relationship
    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    // Scopes
    public function scopeCustomers($query)
    {
        return $query->where('user_type', self::USER_TYPE_CUSTOMER);
    }

    public function scopeAdmins($query)
    {
        return $query->where('user_type', self::USER_TYPE_ADMIN);
    }

    public function childrenCount(): Attribute
    {
        return Attribute::get(fn() => $this->children()->count());
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function userPlans(): HasMany
    {
        return $this->hasMany(UserPlan::class);
    }

    // Scope function to get only active users
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function identity()
    {
        return $this->hasOne(UserIdentity::class);
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function cart()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getCartCountAttribute()
    {
        return  $this->cart()->count() ?? 0;
    }

    public function currentBalance(): Attribute
    {
        return Attribute::get(function () {
            $increases = $this->accountHistory()
                ->where('type', UserAccountHistory::TYPE_INCREASE)
                ->sum('amount');

            $decreases = $this->accountHistory()
                ->where('type', UserAccountHistory::TYPE_DECREASE)
                ->sum('amount');

            return $increases - $decreases;
        });
    }

    public function accountHistory(): HasMany
    {
        return $this->hasMany(UserAccountHistory::class);
    }


    // 🔹 Define Direction Constants
    public const DIRECTION_RIGHT = 'R';
    public const DIRECTION_LEFT = 'L';

    // 🔹 Get Direction Labels
    public static function getDirectionLabels(): array
    {
        return [
            self::DIRECTION_RIGHT => __('Right (R)'),
            self::DIRECTION_LEFT => __('Left (L)'),
        ];
    }

    // 🔹 Scope to Filter Users by Direction
    public function scopeDirection($query, string $direction)
    {
        return $query->where('direction', $direction);
    }

    // 🔹 Get Badge Color for Direction (Optional for UI)
    public static function getDirectionBadgeColor(string $direction): string
    {
        return match ($direction) {
            self::DIRECTION_RIGHT => 'success', // Green for Right
            self::DIRECTION_LEFT => 'warning', // Yellow for Left
            default => 'gray',
        };
    }

    // 🔹 Accessor to Get Readable Direction Label
    public function getDirectionLabelAttribute(): string
    {
        return self::getDirectionLabels()[$this->direction] ?? __('Unknown');
    }
    public function getBVHistoryByYearWeek($year, $week = null)
    {
        $query = $this->bvHistory()
            ->selectRaw(
                'bv_value, YEAR(created_at) as year, WEEK(created_at, 1) as week,
                SUM(CASE WHEN direction = ? THEN bv_value ELSE 0 END) as left_bv,
                SUM(CASE WHEN direction = ? THEN bv_value ELSE 0 END) as right_bv',
                [BVHistory::DIRECTION_OUT, BVHistory::DIRECTION_IN]
            )
            ->whereYear('created_at', $year);

        if ($week !== null) {
            $query->whereRaw('WEEK(created_at, 1) = ?', [$week]);
        }

        return $query
            ->groupBy('year', 'week', 'bv_value')
            ->orderBy('created_at')
            ->get()
            ->groupBy(['year', 'week', 'id'])
        ;
    }
    public function withdrawalRequests(): HasMany
    {
        return $this->hasMany(WithdrawalRequest::class);
    }
}
