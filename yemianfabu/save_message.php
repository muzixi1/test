<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Get the current timestamp
    $timestamp = date("Y-m-d H:i:s");

    // 从文件中读取旧消息
    $oldMessages = file_get_contents('a.txt');

    // 生成随机用户名
    $username = generateRandomUsername();

    // 添加新消息，包括用户名、消息内容和时间戳
    $newMessage = "<strong>{$username}:</strong> {$message} ({$timestamp})<br>";
    $newContent = $oldMessages . $newMessage;

    // 将新内容写入文件
    file_put_contents('a.txt', $newContent);
}

function generateRandomUsername() {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomUsername = '';
    $length = 5;

    // 生成随机用户名
    for ($i = 0; $i < $length; $i++) {
        $randomUsername .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomUsername;
}
?>
