<?php
class Core_Model_Export
{
    protected $_collection;
    protected $_result;

    public function export()
    {
        $result = $this->_collection->getData();
        if (count($result) > 0) {


            $filename = explode("_Model_", get_class($this))[1] . "_exported.csv";
            // mage::log($filename);

            header('Content-Type: text/csv');
            header("Content-Disposition: attachment; filename={$filename}");

            $output = fopen('php://output', 'w');
            fputcsv($output, array_keys($result[0]->getData())); // CSV column headers

            foreach ($result as $row) {
                fputcsv($output, $row->getData());
            }
            fclose($output);
        } else {
            echo "No records found!";
        }
        return $this;
    }
    public function getCollection()
    {
        return $this;
    }
    public function setCollection($collection)
    {
        $this->_collection = $collection;
        return $this;
    }

    public function getData()
    {
        return $this;
    }
}
