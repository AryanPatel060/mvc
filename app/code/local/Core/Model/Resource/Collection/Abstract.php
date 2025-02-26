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
        $this->_model = $model;
        return $this;
    }
    public function select($columns = ['*'])
    {
        $this->_select['FROM'] = $this->_resource->getTableName();
        $this->_select['COLUMNS'] = is_array($columns) ? $columns : [$columns];
        return $this;
    }

    public function getData()
    {
        $data = $this->_resource->getAdapter()->fetchAll($this->prepareQuery());
        foreach ($data as &$_data) {
            $obj = new $this->_model;
            $_data = $obj->setData($_data);
        }
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

        if (isset($this->_select['LEFT_JOIN'])) {
            $joinsql = "";
            foreach ($this->_select['LEFT_JOIN'] as $joinLeft) {
                $joinsql .= sprintf(" LEFT JOIN  %s ON %s ", $joinLeft['tableName'], $joinLeft['condition']);
            }
            $query = $query . " " . $joinsql;
        }
        if (isset($this->_select['RIGHT_JOIN'])) {
            $joinsql = "";
            foreach ($this->_select['RIGHT_JOIN'] as $joinLeft) {
                $joinsql .= sprintf(" RIGHT JOIN  %s ON %s ", $joinLeft['tableName'], $joinLeft['condition']);
            }
            $query = $query . " " . $joinsql;
        }
        if (isset($this->_select['JOIN'])) {
            $joinsql = "";
            foreach ($this->_select['JOIN'] as $joinLeft) {
                $joinsql .= sprintf(" JOIN  %s ON %s ", $joinLeft['tableName'], $joinLeft['condition']);
            }
            $query = $query . " " . $joinsql;
        }
        if (isset($this->_select['WHERE'])) {
            $wheresql = "";
            $count = count($this->_select['WHERE']);
            $conditions = [];
            foreach ($this->_select['WHERE'] as $field => $value) {
                foreach ($value as $_value) {
                    $conditions[] = $this->preparecondition($field, $_value);
                }
            }

            $wheresql .= " WHERE " . implode(' AND ', $conditions);

            $query = $query . " " . $wheresql;
        }
        if (isset($this->_select['GROUP_BY'])) {

            $groupbysql = " GROUP BY ";
            $groupbysql .= implode(',', $this->_select['GROUP_BY']);
            $query = $query . " " . $groupbysql;

            if (isset($this->_select['HAVING'])) {
                $havingsql = "";
                $count = count($this->_select['HAVING']);
                $conditions = [];
                foreach ($this->_select['HAVING'] as $field => $value) {
                    foreach ($value as $_value) {
                        $conditions[] = $this->preparecondition($field, $_value);
                    }
                }

                $havingsql .= " HAVING " . implode(' AND ', $conditions);

                $query = $query . " " . $havingsql;
            }
        }
        if (isset($this->_select['ORDER_BY'])) {

            $orderbysql = "ORDER BY ";
            $orderbysql .= implode(',', $this->_select['ORDER_BY']);
            $query = $query . " " . $orderbysql;
        }
        if (isset($this->_select['LIMIT'])) {
            $query = $query . " LIMIT " . $this->_select['LIMIT'];
            if (isset($this->_select['OFFSET'])) {
                $query = $query . " OFFSET " . $this->_select['OFFSET'];
            }
        }
        // echo $query;
        return $query;
    }
    public function preparecondition($field, $value)
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
                        if($_value == NULL)
                        {
                            $where = " {$field} {$operator} NULL ";
                        }
                        else 
                        {
                            $where = " {$field} {$operator} '{$_value}' ";
                        }
                        break;
                }
            }
        }
        return $where;
    }
    public function leftJoin($tableName, $condition, $columns)
    {
        $this->_select['LEFT_JOIN'][] = ['tableName' => $tableName, 'condition' => $condition, 'columns' => $columns];
        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS %s", $tableName, $columnName, $alias);
        }

        return $this;
    }
   
    public function rightJoin($tableName, $condition, $columns)
    {
        $this->_select['RIGHT_JOIN'][] = ['tableName' => $tableName, 'condition' => $condition, 'columns' => $columns];
        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS %s", $tableName, $columnName, $alias);
        }

        return $this;
    }
    public function join($tableName, $condition, $columns)
    {
        $this->_select['JOIN'][] = ['tableName' => $tableName, 'condition' => $condition, 'columns' => $columns];
        foreach ($columns as $alias => $columnName) {
            $this->_select['COLUMNS'][] = sprintf("%s.%s AS %s", $tableName, $columnName, $alias);
        }

        return $this;
    }
    public function orderBy($columns)
    {
        if (!is_array($columns)) {
            $this->_select['ORDER_BY'] = [$columns];
        } else {
            $this->_select['ORDER_BY'] = $columns;
        }
        return $this;
    }
    public function groupBy($columns)
    {
        if (!is_array($columns)) {
            $this->_select['GROUP_BY'] = [$columns];
        } else {
            $this->_select['GROUP_BY'] = $columns;
        }
        return $this;
    }
    public function having($field, $condition)
    {
        if (!is_array($condition)) {
            $condition = ['eq' => $condition];
        }
        $this->_select['HAVING'][$field][] = $condition;
        return $this;
    }
    public function limit($value)
    {
        $this->_select['LIMIT'] = $value;
        return $this;
    }
    public function offset($value)
    {
        $this->_select['OFFSET'] = $value;
        return $this;
    }
}
