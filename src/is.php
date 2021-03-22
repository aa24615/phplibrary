<?php




/**
 * 判断邮箱是否正确
 * @param string $email 邮箱
 * @return boolean
 */
function is_valid_email($email)
{
    if (strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 判断用户名正确
 * @param string $user 用户名 6-15位 字母打头
 * @return boolean
 */
function is_valid_user($user)
{
    if (!preg_match("/^[a-zA-Z][a-zA-Z0-9_]{6,15}$/", $user)) {
        return false;
    } else {
        return true;
    }
}

/**
 * 判断手机是否正确
 * @param int $phone 手机
 * @return boolean
 */
function is_valid_phone($phone)
{
    if (!preg_match("/13\d|14[57]|15[^4,\D]|17[678]|18\d)\d{8}|170[059]\d{7}/", $str)) {
        return false;
    } else {
        return true;
    }
}

/**
 * 判断是否今天
 * @param string $time 时间戳
 * @return int
 */
function is_today($time = false)
{
    $time = $time ?: time();
    $today = strtotime(date('Y-m-d') . ' 00:00:00');
    if ($time > $today) {
        return true;
    } else {
        return false;
    }
}

/**
 * 判断是否蜘蛛
 * @return boolean
 */
function is_spider()
{
    $robots = array("baiduspider", "googlebot", "sosospider", "360spider", "slurp", "yodaobot", "sogou", "msnbot", "bingbot");
    $agent = strtolower($_SERVER["HTTP_USER_AGENT"]);
    $is = 0;
    foreach ($robots as $val) {
        if (strpos($agent, $val) !== false) {
            $is++;
        }
    }
    if ($is > 0) {
        return true;
    }
    return false;
}
