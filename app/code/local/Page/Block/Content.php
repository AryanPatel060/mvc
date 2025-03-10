<?php
class Page_Block_Content extends Core_Block_Layout
{
    public function __construct()
    {
        $this->setTemplate('page/content.phtml');
    }
}
