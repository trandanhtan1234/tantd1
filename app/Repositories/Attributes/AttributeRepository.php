<?php

namespace App\Repositories\Attributes;

use App\Repositories\Attributes\AttributeRepositoryInterface;
use App\Models\models\attributes;

class AttributeRepository implements AttributeRepositoryInterface
{
    const failed_msg = 'Something went wrong, please try again later!';

    public function getAttributes()
    {
        $attr = attributes::get();

        return $attr;
    }
}