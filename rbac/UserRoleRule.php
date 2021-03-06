<?php
namespace app\rbac;
use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use app\models\User;
class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        //Получаем массив пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', User::findIdentity($user));
        if ($user) {
            $role = $user->role; //Значение из поля role базы данных
            if ($item->name === 'administrator') {
                return $role == User::ROLE_ADMIN;
            } elseif ($item->name === 'user') {
                return $role == User::ROLE_ADMIN || $role == User::ROLE_USER;
            }
        }
        return false;
    }
}