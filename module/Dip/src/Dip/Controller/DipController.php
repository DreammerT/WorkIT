<?php

namespace Dip\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Dip\Model\Dip;
use Dip\Form\DipForm;

class DipController extends AbstractActionController {

    protected $DipTable;

    public function getDipTable()
    {
        if (!$this->DipTable) {
            $sn = $this->getServiceLocator();
            $this->DipTable = $sn->get('Dip\Model\DipTable');
        }
        return $this->DipTable;
    }

    public function indexAction() {
        return new ViewModel(array(
            'Friend' => $this->getDipTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $form = new DipForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = new Dip();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->exchangeArray($form->getData());
                $this->getDipTable()->saveDip($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('punl');
            }
        }
        return array('form' => $form);
    }
}