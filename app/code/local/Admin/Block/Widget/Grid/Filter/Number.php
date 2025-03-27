<?php class Admin_Block_Widget_Grid_Filter_Number extends Admin_Block_Widget_Grid_Filter
{

    public function __construct()
    {
        $this->setTemplate("admin/Widget/filter/number.phtml");
    }
    public function  render()
    {
        return '<div class="mb-3">
                    <input
                        class="form-control mb-2 col' . $this->getClassList() ." ". $this->getValidation() . '"
                        type="number"
                        id="filter-' . $this->getData()['data-index'] . '-from"
                        placeholder="From">
                    <input
                        class="form-control ml-4 col' . $this->getClassList() ." ". $this->getValidation() . '"
                        type="number"
                        id="filter-' . $this->getData()['data-index'] . '-to"
                        placeholder="To">

                </div>';
    }
}
