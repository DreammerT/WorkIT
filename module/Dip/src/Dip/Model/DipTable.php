<?php

namespace Dip\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;

class DipTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->table = $tableGateway;
        $this->tableGateway = $this->table->getAdapter();
    }

    public function getDip($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function fetchAll()
    {
        $resultSet = $this->table->select();
        return $resultSet;
    }

    public function saveDip(Dip $album)
    {
        $data = array(
            'id' => $album->id,
            'Name'  => $album->Name,
        );

        $id = (int)$album->id;
        if ($id == 0) {
            $this->table->insert($data);
        } else {
            if ($this->getDip($id)) {
                $this->table->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

}