<?php
$file = 'online_users.txt';
$timeout = 300; // ۵ دقیقه
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

// خواندن داده‌ها
$users = [];
if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($user_ip, $last_seen) = explode('|', $line);
        if (($time - $last_seen) < $timeout && $user_ip != $ip) {
            $users[] = "$user_ip|$last_seen";
        }
    }
}
$users[] = "$ip|$time";
file_put_contents($file, implode("\n", $users));

echo count($users);
?>