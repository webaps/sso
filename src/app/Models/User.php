<?php

namespace App\Models;

use App\Traits\UseUuid;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property string $id
 * @property string $name
 * @property string $given_name
 * @property string|null $middle_name
 * @property string $family_name
 * @property string|null $nickname
 * @property string $gender
 * @property string $username
 * @property string|null $phone_number
 * @property string $email
 * @property Carbon|null $birthdate
 * @property Carbon|null $phone_number_verified_at
 * @property Carbon|null $email_verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, UseUuid, CrudTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'given_name',
        'middle_name',
        'family_name',
        'nickname',
        'gender',
        'birthdate',
        'phone_number',
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
        'phone_number_verified_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        $name = array_filter([
            $this->given_name,
            $this->middle_name,
            $this->family_name,
        ], 'strlen');

        return implode(' ', $name);
    }

    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(Application::class);
    }
}
