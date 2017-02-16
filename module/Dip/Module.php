<?php
namespace Dip;

use Dip\Model\People;
use Dip\Model\PeopleTable;
use Dip\Model\Dip;
use Dip\Model\DipTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                    'Dip\Model\PeopleTable' =>  function($sm) {
                        $tableGateway = $sm->get('PeopleTableGateway');
                        $table = new PeopleTable($tableGateway);
                         return $table;
                    },
                    'PeopleTableGateway' => function ($sm) {
                        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                        $resultSetPrototype = new ResultSet();
                        $resultSetPrototype->setArrayObjectPrototype(new People());
                    return new TableGateway('staff', $dbAdapter, null, $resultSetPrototype);
                    },

                    'Dip\Model\DipTable' =>  function($sn) {
                        $tableGateway = $sn->get('DipTableGateway');
                        $table = new DipTable($tableGateway);
                        return $table;
                    },
                    'DipTableGateway' => function ($sn) {
                        $dbAdapter = $sn->get('Zend\Db\Adapter\Adapter');
                        $resultSetPrototype = new ResultSet();
                        $resultSetPrototype->setArrayObjectPrototype(new Dip());
                        return new TableGateway('Friends', $dbAdapter, null, $resultSetPrototype);
                    },
            ),
        );
    }
}