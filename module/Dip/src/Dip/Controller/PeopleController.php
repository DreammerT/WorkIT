<?php

namespace Dip\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Dip\Model\Dip;
use Dip\Form\DipForm;

class PeopleController extends AbstractActionController
{

    protected $PeopleTable;

    public function getPeopleTable()
    {
        if (!$this->PeopleTable) {
            $sm = $this->getServiceLocator();
            $this->PeopleTable = $sm->get('Dip\Model\PeopleTable');
        }
        return $this->PeopleTable;
    }

    public function indexAction()
    {
//        return new ViewModel(array(
//            'albums' => $this->getPeopleTable()->fetchAll(),
//        ));

        $sm = $this->serviceLocator->get('Application\Model\ModelTable');
        $user = $sm->getListingDb();
        return array(
            'user'=>$user,
            'albums' => $this->getPeopleTable()->fetchAll(),
        );
    }

    public function searchAction()
    {
        $search = $this->params()->fromQuery("searchonmenu");
        $sm = $this->serviceLocator->get('Application\Model\ModelTable');
        $getsearch = $sm->getglobalsearch($search);
        return array(
            'user'=>$getsearch,
        );
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
                $this->getPeopleTable()->savePeople($album);

                // Redirect to list of albums
                return $this->redirect()->toRoute('punl');
            }
        }
        return array('form' => $form);
    }
//
//    public function editAction()
//    {
//        $id = (int)$this->params()->fromRoute('id', 0);
//        if (!$id) {
//            return $this->redirect()->toRoute('album', array(
//                'action' => 'add'
//            ));
//        }
//        $album = $this->getPeopleTable()->getPeople($id);
//
//        $form = new PeopleForm();
//        $form->bind($album);
//        $form->get('submit')->setAttribute('value', 'Edit');
//
//        $request = $this->getRequest();
//        if ($request->isPost()) {
//            $form->setInputFilter($album->getInputFilter());
//            $form->setData($request->getPost());
//
//            if ($form->isValid()) {
//                $this->getPeopleTable()->savePeople($form->getData());
//
//                // Redirect to list of albums
//                return $this->redirect()->toRoute('album');
//            }
//        }
//
//        return array(
//            'id' => $id,
//            'form' => $form,
//        );
//    }
//
//    public function deleteAction()
//    {
//        $id = (int)$this->params()->fromRoute('id', 0);
//        if (!$id) {
//            return $this->redirect()->toRoute('album');
//        }
//
//        $request = $this->getRequest();
//        if ($request->isPost()) {
//            $del = $request->getPost('del', 'No');
//
//            if ($del == 'Yes') {
//                $id = (int)$request->getPost('id');
//                $this->getPeopleTable()->deletePeople($id);
//            }
//
//            // Redirect to list of albums
//            return $this->redirect()->toRoute('album');
//        }
//
//        return array(
//            'id' => $id,
//            'album' => $this->getPeopleTable()->getPeople($id)
//        );
//    }
//

//}
}