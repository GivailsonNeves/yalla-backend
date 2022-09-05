<?php

namespace App\Models;

use App\Models\Traits\Attributes\CategoryAttributes;
use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use ModelAttributes, SoftDeletes, CategoryAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
