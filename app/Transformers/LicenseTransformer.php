<?php

namespace App\Transformers;

use App\Models\License;
use App\Models\Product;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class LicenseTransformer extends TransformerAbstract
{
    /**
     * @param License[] $licenses
     * @return array
     */
    public function transform(License $license)
    {
        /** @var User $firstUser */
        $firstUser = $license->users()->first();
        /** @var Product $product */
        $product = $license->product;
        $transformed = [
            'user_name' => $firstUser->name,
            'product' => $product->display_name,
            'licence_key' => $this->generateKey($product->internal_name, $firstUser->email),
        ];
        return $transformed;
    }

    private function generateKey($internalName, $userEmail)
    {
        //Sha256 of the product.internal_name + user.email
        $hash = hash('sha256', $internalName . $userEmail);
        return $hash;
    }
}
