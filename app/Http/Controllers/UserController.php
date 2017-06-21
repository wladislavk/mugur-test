<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;

class UserController
{
    const USER_ID = 1;

    public function getSelf()
    {
        /** @var User $user */
        $user = User::find(self::USER_ID);
        $user = fractal($user, new UserTransformer())->toArray();

        return response()->json($user);
    }
}
