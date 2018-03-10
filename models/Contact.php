<?php

class Contact
{

    /**
     * Проверяем корректность данных из формы "Напишите нам"
     *
     * @param $name
     * @param $email
     * @param $message
     * @return array|bool
     */
    public static function checkSendData($name, $email, $message)
    {
        $errors = null;

        if (!User::checkName($name)) $errors[] = 'Некорректное имя: необходимо от 2 до 35 символов.';
        if (!User::checkEmailCorrect($email)) $errors[] = 'Некорректный email.';
        if (!self::checkTextMessage($message)) $errors[] = 'Сообщение должно содержать от 5 до 1000 символов.';

        if (!is_array($errors)) {
            return true;
        }

        return $errors;
    }

    /**
     * Проверка текста сообщения: не меньше 5, не больше 1000 символов.
     *
     * @param $message
     * @return bool
     */
    public static function checkTextMessage($message)
    {
        if (mb_strlen($message) < 5 || mb_strlen($message) > 1000) {
            return false;
        }

        return true;
    }

    /**
     * Возвращает все данные сообщения готового к отправке
     *
     * @param $params
     * @return array
     */
    public static function getMessage($params)
    {
        $message = [
            'email'   => App::EMAIL_SITE,
            'subject' => 'New message from ' . App::NAME_SITE,
            'message' => 'Имя: ' . $params['name'] . '<br>Email: ' . $params['email'] . '<br><br>Сообщение:' . $params['message']
        ];

        return $message;
    }


}