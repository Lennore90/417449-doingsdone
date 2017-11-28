<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

require_once('functions.php');
require_once('data.php');

if (isset($_GET['add'])){
	require_once('templates/forms.php');

}
if (isset($_POST)) {
	
	array_unshift($array_tasks, array('task_name' => $_POST['name'],
									  'date_of_deadline' => $_POST['date'],
									  'task_category'=>$_POST['project'],
									  'task_done'=>false));
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



$content = renderTemplate('templates/index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'array_tasks' => $task_list,
]);

$page_layout = renderTemplate('templates/layout.php', [
    'page_title' => 'Дела в порядке', 
    'page_content' => $content,
    'project_cats' => $project_cats,
    'array_tasks' => $array_tasks,
]);

print ($page_layout);
?>
