<?php

namespace Dip\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DipController extends AbstractActionController {
    public function indexAction() {
        return new ViewModel();
    }
}