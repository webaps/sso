<?php

namespace App\Entities;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use League\OAuth2\Server\Entities\UserEntityInterface;
use OpenIDConnectServer\Entities\ClaimSetInterface;

class UserEntity implements ClaimSetInterface, UserEntityInterface
{
    private User|null $user;

    /**
     * UserEntity constructor.
     * @param mixed $identifier
     */
    public function __construct(mixed $identifier)
    {
        $this->user = User::find($identifier);
    }

    public function getClaims(): array
    {
        if (!$this->user instanceof User) {
            return [];
        }

        return [
            'name' => $this->user->name,
            'given_name' => $this->user->given_name,
            'middle_name' => $this->user->middle_name,
            'family_name' => $this->user->family_name,
            'nickname' => $this->user->nickname,
            'gender' => $this->user->gender,
            'birthdate' => $this->user->birthdate,
            'phone_number' => $this->user->phone_number,
            'phone_number_verified' => !!$this->user->phone_number_verified_at,
            'username' => $this->user->username,
            'email' => $this->user->email,
            'email_verified' => !!$this->user->email_verified_at
        ];
    }

    public function getIdentifier()
    {
        return $this->user->getKey();
    }
}
