<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Timbre;
use App\Models\Bid as Model;
use \Core\View;

/**
 * Bid controller
 *
 * PHP version 7.0
 */
class Bid extends \Core\Controller{

    public function indexAction()
    {      
        $bid = Model::getAll();
        View::renderTemplate('bid/index.html', ['bid' => $bid]);
    }
}
