<?php

namespace App\Events\Backend\Categories;

use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryCreated.
 */
class CategoryCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $category;

    /**
     * @param $page
     */
    public function __construct($category)
    {
        $this->category = $category;
    }
}
