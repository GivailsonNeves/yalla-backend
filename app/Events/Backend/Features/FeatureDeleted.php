<?php

namespace App\Events\Backend\Features;

use Illuminate\Queue\SerializesModels;

/**
 * Class FeatureDeleted.
 */
class FeatureDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $feature;

    /**
     * @param $feature
     */
    public function __construct($feature)
    {
        $this->feature = $feature;
    }
}
