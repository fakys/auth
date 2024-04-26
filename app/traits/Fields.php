<?php
trait Fields//вот сейчас сижу пишу эти комментарии и думаю, зачем я это создал ?)
{
    protected $fields = [
        'fio'=>'ФИО',
        'email'=>'Email',
        'login'=>'Логин',
        'ava'=>'Аватар',
        'password'=>'Пороль',
        'repeat_password'=>'Повторите пароль'
    ];
    protected function get_field($field)
    {
        return $this->fields[$field];
    }

}