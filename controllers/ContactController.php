<?php

class ContactController
{
    /**
     * Страница "Обратная связь"
     */
    public function actionIndex()
    {
        # Сценарий для отправки обратной связи
        if (isset($_POST['send'])) {
            $send = [
                'name'    => $_POST['contact_name'],
                'email'   => $_POST['contact_email'],
                'message' => $_POST['contact_message']
            ];

            # Проверить корректность полученных  данных
            $resultSend = Contact::checkSendData($send['name'], $send['email'], $send['message']);

            # Отправка сообщения
            if ($resultSend === true) {
                $message = Contact::getMessage($send);
                App::sendEmail($message['email'], $message['subject'], $message['message']);
            }
        }

        # Заголовок страницы
        $page = ['title' => 'Связь с нами'];

        include_once(ROOT . '/views/contact/index.php');
    }
}