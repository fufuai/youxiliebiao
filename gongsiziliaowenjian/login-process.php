<?php
// 启动会话
session_start();

// 检查表单是否通过POST提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 获取表单数据
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // 检查输入字段是否为空
    if (empty($username) || empty($password)) {
        echo "用户名或密码不能为空！<br>";
        echo '<a href="login.html">返回登录页面</a>';
        exit();
    }

    // 检查用户名是否存在
    if (!isset($_SESSION['users'][$username])) {
        echo "用户名不存在！<br>";
        echo '<a href="login.html">返回登录页面</a>';
        exit();
    }

    // 获取存储的用户数据
    $user = $_SESSION['users'][$username];
    
    // 检查密码是否正确
    if (!password_verify($password, $user['password'])) {
        echo "密码错误！<br>";
        echo '<a href="login.html">返回登录页面</a>';
        exit();
    }

    // 登录成功，跳转到用户主页面
    header("Location: https://1.868faka.xyz/ds/#shop/");
    exit(); // 确保代码结束后不会继续执行

} else {
    // 非POST请求，显示错误信息
    echo "无效的请求方式！<br>";
    echo '<a href="login.html">返回登录页面</a>';
    exit();
}
?>
