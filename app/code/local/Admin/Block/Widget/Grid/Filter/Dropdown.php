<?php class Admin_Block_Widget_Grid_Filter_Dropdown extends Admin_Block_Widget_Grid_Filter
{
    public function __construct()
    {
        $this->setTemplate("admin/Widget/filter/dropdown.phtml");
    }

    public function getOption()
    {
        return $this->getData()['option'];
    }
    public function render()
    {
        $options = "";
        foreach ($this->getOption() as $option) {
            $options .= '<option  value="' . $option->getCategoryId() . '">.' . $option->getName() . '</option>';
        }

        return '<select class="form-control' . $this->getClassList() . '" name="select" id="filter-' . $this->getData()['data-index'] . '">
                <option  value="">-select-</option>'
            . $options . '</select>';
    }
}
