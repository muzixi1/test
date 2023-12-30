<?php
session_start();

// 设置用户的cookie或从现有的cookie中获取用户标识
if (!isset($_COOKIE['user_id'])) {
    $user_id = uniqid(); // 生成一个唯一的用户标识
    setcookie('user_id', $user_id, time() + 180); // 180秒 = 3分钟
} else {
    $user_id = $_COOKIE['user_id'];
}

// 获取在线用户信息（这里简单使用一个文本文件存储，实际应该使用数据库等持久存储）
$onlineUsersFile = 'online_users.txt';
$onlineUsers = [];

if (file_exists($onlineUsersFile)) {
    $onlineUsers = unserialize(file_get_contents($onlineUsersFile));
}

// 更新或添加当前用户的最后活动时间
$onlineUsers[$user_id] = time();

// 清理超过3分钟未活动的用户
$inactiveTime = 3;
foreach ($onlineUsers as $userId => $lastActivityTime) {
    if (time() - $lastActivityTime > $inactiveTime) {
        unset($onlineUsers[$userId]);
    }
}

// 保存在线用户信息
file_put_contents($onlineUsersFile, serialize($onlineUsers));

// 输出在线用户数量
echo count($onlineUsers);
?>
