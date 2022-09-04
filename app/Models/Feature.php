<?php

namespace App\Models;

use App\Models\Traits\Attributes\FeatureAttributes;
use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends BaseModel
{
    use ModelAttributes, SoftDeletes, FeatureAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
