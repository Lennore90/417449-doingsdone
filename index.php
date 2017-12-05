<?php
require_once('functions.php');
require_once('data.php');
require_once('userdata.php');
// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');




// показывать или нет выполненные задачи
$show_complete_tasks = $_COOKIE["show_check"] ?? 0; 
if (isset($_GET['check'])) { 
$show_complete_tasks = !$show_complete_tasks; 
setcookie('show_check', $show_complete_tasks, strtotime("+30 days"), '/'); 
} 





$required_fields=['name','project', 'date'];
$errors=[];

$error='<p class="form__message">Заполните это поле</p>';
$class_error='form__input--error';

if (!empty($_POST)) {
  	foreach ($required_fields as $field_name) {
	    if ($field_name != 'project' ) {
	    	if (empty($_POST[$field_name])) {
	        	$errors[]=$field_name;
	        }         
	    } else {
	    	if (!in_array($_POST['project'], $project_cats)) {
	    		$errors[] = $field_name;
	    	}
	    }
  	}

	if (empty($errors)) {
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


$add_form = '';

if (isset($_GET['add']) || !empty($errors)){
	$add_form=renderTemplate('templates/forms.php', [
		'errors' => $errors,
		'error' => $error,
		'class_error' => $class_error,
		'project_cats' => $project_cats,
	]);
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
    'add_form' => $add_form,
]);

print ($page_layout);
?>