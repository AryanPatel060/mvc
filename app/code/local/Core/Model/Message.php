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
    public function addError($key,$message)
    {
        $messages = $this->get('messages');
        $messages['error'][$key] = $message;
        $this->set('messages', $messages);
        return $this;
    }
    public function addWarning($key,$message)
    {
        $messages = $this->get('messages');
        $messages['warning'][$key] = $message;
        $this->set('messages', $messages);

        return $this;
    }
    public function getSuccess()
    {
        $messages = $this->get('messages');
        $message = $messages['success'];
        $messages['success'] = [];
        $this->set('messages', $messages);
        return $message;
    }
    public function getError()
    {
        $messages = $this->get('messages');
        $message = $messages['error'];
        $messages['error'] = [];
        $this->set('messages', $messages);
        return $message;
    } public function getWarning()
    {
        $messages = $this->get('messages');
        $message = $messages['warning'];
        $messages['warning'] = [];
        $this->set('messages', $messages);
        return $message;
    }

}
