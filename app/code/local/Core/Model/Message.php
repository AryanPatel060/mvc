<?php class Core_Model_Message extends Core_Model_Session
{
    public function addMessage()
    {
        $this->__construct();
        $messages = [
            "success" => [],
            "error" => [],
            "warning" => []
        ];
        $this->set('messages', $messages);
        return $this;
    }
    public function addSuccess($key, $message)
    {
        $messages = $this->get('messages');
        $messages['success'][$key] = $message;
        $this->set('messages', $messages);

        return $this;
    }
    public function addError($message)
    {
        $messages = $this->get('messages');
        $messages['error'][] = $message;
        $this->set('messages', $messages);
        return $this;
    }
    public function addWarning($message)
    {
        $messages = $this->get('messages');
        $messages['warning'][] = $message;
        $this->set('messages', $messages);

        return $this;
    }
    public function getSuccess()
    {
        $messages = $this->get('messages')['success'];
        $message = $messages['success'];
        $messages['success'] = [];
        $this->set('messages', $messages);
        return $message;
    }
}
