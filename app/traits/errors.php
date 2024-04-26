<?php
trait errors//трейт для обработки частых ошибок
{
    //создал для того что бы не повторять код, просто он ещё используется в классе Login
    public array $gets = [];//контекс куда записываются ошибки или данные введеные пользователям
    protected array $messages = [];
    public function required(string  $field)//Валидация обязательных полей ввода
    {

        if(!$this->post[$field]){

            $this->add_messages($field, "Поле {$this->get_field($field)} обязательное!!");
        }
    }
    protected function add_messages($field , $messages)// доюовляет ошибку в общий массив
    {
        if(empty($this->messages[$field])||!$this->messages[$field]){
            $this->messages[$field] = $messages;
        }
    }
    public function errors(string $key)// проверяет есть ли поля ошибка
    {
        if(isset($this->messages[$key])){
            return true;
        }
        return false;
    }
    public function messages()// при вызове этого метода в контекс передаются ошибки из массива messages
    {
        $this->gets = $this->messages;
        return $this;
    }
}