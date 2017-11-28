<?
function renderTemplate ($templatePath, $templateVars) {
	$result='';

	if (file_exists ($templatePath)) {
		ob_start();
		extract($templateVars);
		require_once $templatePath;
		$result = ob_get_clean();
	}

	return $result;
}

function count_tasks($project_name,$array_tasks){
    $taskCount = 0; 
    if ($project_name === 'Все') { 
    $taskCount=count($array_tasks);
    } else {
        foreach ($array_tasks as $task) {
            if ($task['task_category'] == $project_name){ 
                $taskCount++;
            }
               
        }
        
    } 

return $taskCount; }

function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}
?>