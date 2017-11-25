<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

require_once('functions.php');
require_once('data.php');

$content = renderTemplate('templates/index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'array_tasks' => $array_tasks,
]);

$page_layout = renderTemplate('templates/layout.php', [
    'page_title' => 'Дела в порядке', 
    'page_content' => $content,
    'project_cats' => $project_cats,
    'array_tasks' => $array_tasks,
]);

print ($page_layout);
?>
