<?php class Core_Block_Message extends Core_Block_Layout {
    public function __construct()
    {
        $this->setTemplate('page/message.phtml');
    }
    public function getSuccess()
    {
        $message = $this->getMessage();
        return $message->getSuccess();
    }
    public function getError()
    {
        $message = $this->getMessage();
        return $message->getError();
    }

    public function getWarning()
    {
        $message = $this->getMessage();
        return $message->getWarning();
    }



} ?>