<?php
class Core_Model_Resource_Collection_Abstract
{
    protected $_resource;
    protected $_model;
    protected $_select = [];

    public function setResource($resource)
    {

        $this->_resource = $resource;
        return $this;
    }
    public function setModel($model)
    {
        // $this->select();
        $this->_model = $model;
        return $this;
    }



    public function select()
    {
        $this->_select['FROM'] = $this->_resource->getTableName();
        $this->_select['COLUMNS'] = ['*'];
        // $this->getdata();

    }

    public function getData()
    {
        // $query = sprintf("SELECT %s FROM %s", $this->_select['COLUMNS'][0], $this->_select['FROM']);

        $data = $this->_resource->getAdapter()->fetchAll($this->prepareQuery());

        foreach ($data as &$_data) {
            $obj = new $this->_model;
            $_data = $obj->setData($_data);
        }
        // die();
        return $data;
    }
    public function addFieldToFilter($field, $condition)
    {
        if (!is_array($condition)) {
            $condition = ['eq' => $condition];
        }
        $this->_select['WHERE'][$field][] = $condition;
        return $this;
    }
    public function prepareQuery()
    {
        $query = sprintf("SELECT %s FROM %s", implode(',', $this->_select['COLUMNS']), $this->_select['FROM']);
    
        if (isset($this->_select['JOIN_LEFT'])) {
            $joinsql = "";
            foreach ($this->_select['JOIN_LEFT'] as $joinLeft) {
                $joinsql .= sprintf(" LEFT JOIN  %s ON %s ", $joinLeft['tableName'], $joinLeft['condition']);
            }
            $query = $query ." ".$joinsql;
        }
        if (isset($this->_select['WHERE'])) {
            $wheresql = "";
            $count = count($this->_select['WHERE']);
            $conditions = [];
            foreach ($this->_select['WHERE'] as $field => $value) {
                foreach ($value as $_value) {
                    $conditions[] = $this->where($field, $_value);
                }
            }

            $wheresql .= " WHERE " . implode(' AND ', $conditions);

            $query = $query ." ".$wheresql;
            
        }
  
        return $query ;
    }
    public function where($field, $value)
    {
        if (is_array($value)) {

            foreach ($value as $operator => $_value) {
                switch (strtoupper($operator)) {
                    case 'IN':
                    case 'NOT IN':

                        $_value = (is_array($_value)) ? $_value : [$_value];

                        foreach ($_value as $key => $val) {

                            $inarryvalues[] = (is_string($val)) ? "'{$val}'" : "{$val}";
                        }
                        $_value = implode(',', $inarryvalues);
                        $where  = " {$field} {$operator} ({$_value}) ";
                        break;

                    case 'BETWEEN':
                    case 'NOT BETWEEN':
                        foreach ($value as $key => $val) {
                            if (is_array($val)) {
                                foreach ($val as $limits) {
                                    $betweenvalues[] = (is_string($limits)) ? "'{$limits}'" : "{$limits}";
                                }
                            } else {
                                $betweenvalues[] = (is_string($val)) ? "'{$val}'" : "{$val}";
                            }
                        }
                        $betweenvaluestring = implode(' AND ', $betweenvalues);
                        $where  =   " {$field} {$operator} {$betweenvaluestring}";
                        break;
                    case 'EQ':
                        $where = "{$field} = '{$_value}'";
                        break;

                    default:
                        $where = " {$field} {$operator} '{$_value}' ";
                        break;
                }
            }
        }
        return $where;
    }
    public function joinLeft($tableName, $condition, $columns)
    {
        $this->_select['JOIN_LEFT'][] = ['tableName' => $tableName, 'condition' => $condition, 'columns' => $columns];
        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS %s", $tableName, $columnName, $alias);
        }

        return $this;
    }
}
