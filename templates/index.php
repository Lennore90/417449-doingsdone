<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.html" method="post">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
<<<<<<< HEAD
            <a href="/?check">                
                <? if ($show_complete_tasks == 0):?>
                    <input class="checkbox__input visually-hidden" type="checkbox">
                <? elseif ($show_complete_tasks == 1):?>
                <input class="checkbox__input visually-hidden" type="checkbox" checked>  
                <? endif; ?>              
=======
            <a href="/?check">
                <?if ($show_complete_tasks == 1) :?>
                    <input class="checkbox__input visually-hidden" type="checkbox" checked>
                <? else:?>
                    <input class="checkbox__input visually-hidden" type="checkbox">
                <? endif;?>               
>>>>>>> 628120d99c53449c60fda39df4f0ada7c92fac6b
                <span class="checkbox__text">Показывать выполненные</span>
            </a>
        </label>
    </div>

    <table class="tasks">

        <?php foreach ($array_tasks as $key => $value) :?>
            <?php if (!$value['task_done'] || ($show_complete_tasks == 1)):?>
                <?php
                $task_class = '';
                $task_checked = '';
                if ($value['task_done']) {
                    $task_class = 'task--completed';
                    $task_checked = 'checked';
                } else {
                    if (!empty($value['date_of_deadline']) && ((strtotime($value['date_of_deadline'])- time())/86400) <= 0) {
                        $task_class = 'task--important';
                    }
                }
            ?>
            <tr class="tasks__item task <?=$task_class ?>")> 
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden" type="checkbox" <?=$task_checked?>>
                        <span class="checkbox__text"><?=$value['task_name']?></span>
                    </label>                
                </td>
                <td class="task__file"><?=$value['task_file']?></td>
                <td class="task__date"><?=$value['date_of_deadline']?></td>
            </tr>
            <?php endif?>
        <?php endforeach ;?>
    </table>
</main>