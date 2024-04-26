<?php
trait errors
{
    public array $gets = [];
    protected array $messages = [];
    public function required(string  $field)
    {

        if(!$this->post[$field]){

            $this->add_messages($field, "Поле {$this->get_field($field)} обязательное!!");
        }
    }
    protected function add_messages($field , $messages)
    {

        if(empty($this->messages[$field])||!$this->messages[$field]){
            $this->messages[$field] = $messages;
        }
    }
    public function errors(string $key)
    {
        if(isset($this->messages[$key])){

            return true;
        }
        return false;
    }
    public function messages()
    {
        $this->gets = $this->messages;
        return $this;
    }
}