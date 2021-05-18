<?php

namespace App\Repositories;

use App\Entities\UserEntity;
use App\Models\User;
use OpenIDConnectServer\Repositories\IdentityProviderInterface;

class IdentityRepository implements IdentityProviderInterface
{

    public function getUserEntityByIdentifier($identifier)
    {
        return new UserEntity($identifier);
    }
}
