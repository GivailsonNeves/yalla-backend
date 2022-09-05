<?php

namespace App\Events\Backend\Features;

use Illuminate\Queue\SerializesModels;

/**
 * Class FeatureCreated.
 */
class FeatureCreated
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
