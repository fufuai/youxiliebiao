<?php
// 启动会话
session_start();

// 检查表单是否通过POST提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 获取表单数据
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // 检查字段是否为空
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "所有字段都必须填写！<br>";
        echo '<a href="register.html">返回注册页面</a>';
        exit();
    }

    // 检查密码是否匹配
    if ($password !== $confirmPassword) {
        echo "密码不匹配！<br>";
        echo '<a href="register.html">返回注册页面</a>';
        exit();
    }

    // 简单的邮箱格式验证
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "无效的邮箱格式！<br>";
        echo '<a href="register.html">返回注册页面</a>';
        exit();
    }

    // 模拟数据库检查用户名是否已存在
    if (isset($_SESSION['users'][$username])) {
        echo "用户名已经存在！<br>";
        echo '<a href="register.html">返回注册页面</a>';
        exit();
    }

    // 密码加密
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 存储用户数据（这里使用会话存储，实际应使用数据库）
    $_SESSION['users'][$username] = [
        'email' => $email,
        'password' => $hashedPassword,
    ];

    // 在注册成功之前先进行跳转
    header("Location: login.html"); // 跳转到登录页面
    exit(); // 确保代码结束后不会继续执行

} else {
    // 非POST请求，显示错误信息
    echo "无效的请求方式！<br>";
    echo '<a href="register.html">返回注册页面</a>';
    exit();
}
?>
