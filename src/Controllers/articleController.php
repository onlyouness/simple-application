<?php
namespace Hp\Phpexe\Controllers;
use Hp\Phpexe\App\FrontController;

class articleController extends FrontController {
    public function showAction($id){
        echo $id;
    }
}