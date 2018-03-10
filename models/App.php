<?php

class App
{
    const NAME_SITE = 'Example project';
    const EMAIL_SITE = 'email@gmail.com';

    /**
     * Отправляет email сообщение
     *
     * @param $email
     * @param $subject
     * @param $text
     * @return bool
     */
    public static function sendEmail($email, $subject, $text)
    {
        $headers = "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "From: \"" . self::NAME_SITE . "\" <" . self::EMAIL_SITE . ">\r\n";

        $result = mail($email, $subject, $text, $headers);

        return $result;
    }


    /**
     * Перенаправление на страницу "Ошибка 404"
     */
    public static function locationPageNotFound()
    {
        header('Location: /404');
    }

    /**
     * Вернет содержимое указаного файла
     *
     * @param $path
     * @param $params - массив данных которые мы передаем на страницу
     * @return bool|string
     */
    public static function getContentFile($path, $params = [])
    {

        if (file_exists($path)) {
            ob_start();
            include($path);
            $file_content = ob_get_contents();
            ob_end_clean();

            return $file_content;
        }

        return false;
    }

    /**
     * Очищаем строку от тегов HTML
     *
     * @param $str
     * @return string
     */
    public static function clearStr($str)
    {
        $str = strip_tags($str);
        $str = htmlentities($str, ENT_QUOTES, "UTF-8");
        $str = htmlspecialchars($str, ENT_QUOTES);

        return $str;
    }


    /**
     * Возвращает строку для подключение переданых CSS файлов на страницу
     *
     * @param array $files
     * @return string
     */
    public static function includeCssFiles($files)
    {
        $str = '';

        for ($i = 0; $i < count($files); $i++)
            $str .= "\n\t<link rel='stylesheet' type='text/css' href='" . $files[$i] ."'>";

        $str .= "\n";

        return $str;
    }

}