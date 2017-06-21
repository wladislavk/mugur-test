<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\User;
use App\Transformers\LicenseTransformer;

class LicenseController
{
    public function getLicenses($userId)
    {
        /** @var User $user */
        $user = User::find($userId);
        $licenses = $user->licenses->all();
        $licenses = fractal($licenses, new LicenseTransformer())->toArray();

        return response()->json(['data' => $licenses]);
    }
}
