<?php
namespace Hp\Phpexe\Controllers;
use Hp\Phpexe\App\FrontController;


class indexController extends FrontController
{
    public function indexAction()
    {
        return $this->renderView('index.view.php');
    }
}