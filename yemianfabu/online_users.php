<?php
session_start();

function getOnlineUsersCount() {
    $onlineUsers = [];

    if (isset($_SESSION['online_users'])) {
        $onlineUsers = $_SESSION['online_users'];
    }

    $userIP = $_SERVER['REMOTE_ADDR'];

    if (!in_array($userIP, $onlineUsers)) {
        $onlineUsers[] = $userIP;
        $_SESSION['online_users'] = $onlineUsers;
    }

    // 清理不活跃的用户，例如超过一定时间未活动的用户
    $onlineUsers = array_filter($onlineUsers, function($ip) {
        // 在此处定义不活跃的时间阈值，例如 30 分钟
        $inactiveTime = 30 * 60; // 30分钟（以秒为单位）
        $lastActivity = $_SESSION['user_activity'][$ip] ?? 0;
        return (time() - $lastActivity) < $inactiveTime;
    });

    // 更新用户的最后活跃时间
    $_SESSION['user_activity'][$userIP] = time();

    // 更新在线用户数组并返回在线人数
    $_SESSION['online_users'] = $onlineUsers;
    return count($onlineUsers);
}

// 返回纯数字格式的在线用户数量
echo getOnlineUsersCount();
?>
