<?php
namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $sm = $this->serviceLocator->get('Application\Model\ModelTable');
        $user = $sm->getListingDb();
        return array(
            'user'=>$user,
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
}
?>