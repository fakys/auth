<?php
namespace app\traits\Fields;
trait Fields
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