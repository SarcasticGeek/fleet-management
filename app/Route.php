<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $timestamps = false;

    public function getParentId(): ?int
    {
        return self::getAttribute('parent_id');
    }
}
