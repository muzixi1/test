<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Get the current timestamp
    $timestamp = date("Y-m-d H:i:s");

    // ���ļ��ж�ȡ����Ϣ
    $oldMessages = file_get_contents('a.txt');

    // ��������û���
    $username = generateRandomUsername();

    // �������Ϣ�������û�������Ϣ���ݺ�ʱ���
    $newMessage = "<strong>{$username}:</strong> {$message} ({$timestamp})<br>";
    $newContent = $oldMessages . $newMessage;

    // ��������д���ļ�
    file_put_contents('a.txt', $newContent);
}

function generateRandomUsername() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomUsername = '';
    $length = 5;

    // ��������û���
    for ($i = 0; $i < $length; $i++) {
        $randomUsername .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomUsername;
}
?>
