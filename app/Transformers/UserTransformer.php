<?php

namespace App\Transformers;

use App\Models\License;
use App\Models\Product;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        /** @var License $firstLicense */
        $firstLicense = $user->licenses()->first();
        /** @var Product $product */
        $product = $firstLicense->product;

        return [
            'data' => [
                'user_name' => $user->name,
                'address' => "{$user->address1}, {$user->address2}, {$user->country}",
                'membership' => $product->display_name,
            ],
        ];
    }
}
