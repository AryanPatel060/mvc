<?php class Admin_Block_Widget_Grid_Filter_Abstract 
{

  public function getValidation()
  {
      if (isset($this->getData()['validation'])) {
          return $this->getData()['validation'];
      }
      return "";
  }
  public function getClassList()
  {
      if (isset($this->getData()['class-list'])) {
          return $this->getData()['class-list'];
      }
      return "";
  }
  public function getData()
  {

  }
} ?>