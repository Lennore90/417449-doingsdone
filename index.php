<?php

session_start();

require_once('functions.php');
require_once('data.php');
require_once('userdata.php');

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');
 
$error='<p class="form__message">Заполните это поле</p>';
$class_error='form__input--error';
 
$errors = [];
 
$required_fields = [
    'login' => ['email','password'],
    'add' => ['name','project','date']
];
 
if (!empty($_POST['action'])) {
    $action = $_POST['action'];
    foreach ($required_fields[$action] as $field_name) {
        if (!array_key_exists($field_name,$_POST) || empty($_POST[$field_name])) {
            $errors[$action][] = $field_name;
        } else {
            if ($field_name == 'project' && !in_array($_POST['project'], $project_cats)) {
                $errors[$action][] = $field_name;
            }
 
            if ($field_name == 'email' && !filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
                $errors[$action][] = $field_name;
            }
        }
    }
 
    if (empty($errors[$action])) {
        if ($action == 'login') {
            $user = searchUser($_POST['email'],$users);
            if (!empty($user)&&(password_verify($_POST['password'],$user['password']))) {
                $_SESSION['user'] = $user;
                header("Location: /index.php" );
            } else {
                $errors['login'][] = 'password';
            }
        }
 
        if ($action == 'add') {
            $new_task =[
                'task_name' => htmlspecialchars($_POST['name']),
                'date_of_deadline' =>date('d.m.Y',strtotime($_POST['date'])),
                'task_category'=>$_POST['project'],
                'task_done'=>false,
                'task_file'=> ''
            ];
 
            if (is_uploaded_file ($_FILES['preview']['tmp_name'])&&move_uploaded_file($_FILES['preview']['tmp_name'], $_FILES['preview']['name'])){
                $new_task['task_file']=$_FILES['preview']['name'];
            }
 
            array_unshift($array_tasks,$new_task);
        }
    }
}
 
$task_list = [];
 
if (isset($_GET['project_id'])) {
    $index=$_GET['project_id'];
    if (array_key_exists($index, $project_cats)) {
        $cat=$project_cats[$index];
        if ($cat== 'Все'){
                $task_list=$array_tasks;
        } else {
            foreach ($array_tasks as $task) {
                if ($task['task_category']== $cat) {
                    $task_list[]=$task;
                }
            }
        }
    }else {
        http_response_code(404);
    }
} else {
    $task_list = $array_tasks;
}
 
// показывать или нет выполненные задачи
$show_complete_tasks = $_COOKIE["show_check"] ?? 0;
if (isset($_GET['check'])) {
    $show_complete_tasks = !$show_complete_tasks;
    setcookie('show_check', $show_complete_tasks, strtotime("+30 days"), '/');
}
 
 
$add_form = '';
 
if (!isset($_SESSION['user'])) {
    $user=[];
    $content = renderTemplate('templates/guest.php', []);
   
    if(isset($_GET['auth_form'])||(!empty($errors['login']))) {
        $add_form=renderTemplate('templates/auth_form.php', [
            'errors' => $errors['login'] ?? [],
            'error' => $error,
            'class_error' => $class_error,
            'users' => $users,
        ]);
    }
} else {
 
    $content = renderTemplate('templates/index.php', [
        'show_complete_tasks' => $show_complete_tasks,
        'array_tasks' => $task_list,
    ]);
 
    if (isset($_GET['add']) || !empty($errors['add'])){
        $add_form=renderTemplate('templates/forms.php', [
            'errors' => $errors['add'] ?? [],
            'error' => $error,
            'class_error' => $class_error,
            'project_cats' => $project_cats,
        ]);
    } 
    if (isset($_GET['logout'])){
    	require_once('logout.php');
    }
}
 
$page_layout = renderTemplate('templates/layout.php', [
    'page_title' => 'Дела в порядке',
    'page_content' => $content,
    'project_cats' => $project_cats,
    'array_tasks' => $array_tasks,
    'add_form' => $add_form,
    'user' => $_SESSION ['user'],
]);
 
print ($page_layout);
var_dump($_SESSION);
?>