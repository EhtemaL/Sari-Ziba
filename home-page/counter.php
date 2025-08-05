<?php
$total_file = 'visits_total.txt';
$today_file = 'visits_today.txt';

$today = date('Y-m-d');

// اگر فایل‌ها نبودن، بساز
if (!file_exists($total_file)) file_put_contents($total_file, "0");
if (!file_exists($today_file)) file_put_contents($today_file, "$today|0");

// خوندن مقادیر فعلی
$total = (int)file_get_contents($total_file);
list($saved_date, $today_count) = explode('|', file_get_contents($today_file));
$today_count = (int)$today_count;

// افزایش شمارنده
$total++;
if ($saved_date == $today) {
    $today_count++;
} else {
    $today_count = 1;
    $saved_date = $today;
}

// ذخیره دوباره
file_put_contents($total_file, $total);
file_put_contents($today_file, "$saved_date|$today_count");

// خروجی JSON
echo json_encode([
    'total' => $total,
    'today' => $today_count
]);
?>