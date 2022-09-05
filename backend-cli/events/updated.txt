<?php

namespace App\Events\Backend\Features;

use Illuminate\Queue\SerializesModels;

/**
 * Class FeatureUpdated.
 */
class FeatureUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $feature;

    /**
     * @param $page
     */
    public function __construct($feature)
    {
        $this->feature = $feature;
    }
}
