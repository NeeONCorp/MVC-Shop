<?php

class AdminBase
{
    /**
     * Проверяет является ли пользователь администратором.
     * В противном случае перенаправит пользователя на другую страницу.
     *
     * @return bool
     */
    public static function checkAdmin()
    {

        $userId = User::checkLogged();
        $isAdmin = User::isAdmin($userId);

        if ($isAdmin) return true;

        header('Location: /404');
    }

    /**
     * Производит загрузку файла на сервер
     *
     * @param array $file - Информация о файле из $_FILES. Содержит ключи: name, tmp_name
     * @param array $fileSave - Данные для сохранения. Содержит ключи: path, name
     * @param array $allowExtensions - Разрешенные форматы файлов для загрузки. Если переменная пустая, то ограничения
     * отсутствуют.
     * @return array|bool
     */
    public static function uploadFile($file, $fileSave, $allowExtensions = array())
    {
        $errors = null;

        $fileSave['path'] = ROOT . '/uploads/' . $fileSave['path'];
        $fileExtension = end(explode('.', $file['name']));

        $checkData = self::checkDataUploadFile($file, $fileSave);

        if ($checkData) {

            # Проверка на запрещенность формата файла
            if (count($allowExtensions) > 0) {
                if (!in_array($fileExtension, $allowExtensions)) {
                    $errors[] = 'Данный формат файлов (.' . $fileExtension . ') запрещен для загрузки.';
                }
            }

            # Если формат файла разрешен
            if (!is_array($errors)) {

                # Создаем директорию если ее не существует
                if (!is_dir($fileSave['path'])) {
                    mkdir($fileSave['path']);
                }

                # Сохраняем файл
                if (!copy($file['tmp_name'], $fileSave['path'] . '/' . $fileSave['name'] . '.' . $fileExtension)) {
                    $errors[] = 'Ошибка загрузки файла.';
                }

                if (!is_array($errors)) {
                    return true;
                }

            }


        } else $errors[] = 'Неизвестная ошибка.';

        return $errors;
    }

    /**
     * Проверка передаваемых данных при загрузке файла
     *
     * @param $file
     * @param $fileSave
     * @return array|bool
     */
    private static function checkDataUploadFile($file, $fileSave)
    {
        if (!is_array($file) || !is_array($fileSave)) return false;

        if (!array_key_exists('name', $file)) return false;
        if (!array_key_exists('tmp_name', $file)) return false;
        if (!array_key_exists('path', $fileSave)) return false;
        if (!array_key_exists('name', $fileSave)) return false;

        if (!file_exists($file['tmp_name'])) return false;
        if ($file['name'] == '') return false;
        if ($fileSave['name'] == '') return false;

        return true;
    }

    /**
     * Конвертирует значение boolean в число и возвращает его противоположность
     * true => 0
     * false => 1
     *
     * Необходимо при работе с чекбоксами
     *
     * @param $boolean
     * @return int
     */
    public static function convertBooleanInOppositeNumber ($boolean) {
        $number = 0;

        if($boolean === 'false' || $boolean === false) $number = 1;

        return $number;
    }

    /**
     * Конвертирует значение boolean в число и возвращает его противоположность
     * true => 1
     * false => 0
     *
     * Необходимо при работе с чекбоксами
     *
     * @param $boolean
     * @return int
     */
    public static function convertBooleanInNumber($boolean)
    {
        $number = 1;

        if($boolean === 'false' || $boolean === false) $number = 0;

        return $number;
    }
}