<?php
namespace Application\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;
class ModelTable extends TableGateway{
    protected $table;

    public function __construct(TableGateway $adapter){
        $this->table = $adapter;
        $this->adapter = $this->table->getAdapter();
    }
    public function getListingDb(){
        $Sql = new Sql($this->adapter);
        $select = $Sql->select('user');
        $statment = $Sql->prepareStatementForSqlObject($select)->execute();
        $rs = new ResultSet();
        return $rs->initialize($statment)->buffer();
    }
    public function getglobalsearch($search)
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select('user')
            ->where("display_name like '%" . $search . "%'");
        $sm = $sql->prepareStatementForSqlObject($select)->execute();
        $re = new ResultSet();
        return $re->initialize($sm)
            ->buffer()
            ->toArray();
    }
}
?>