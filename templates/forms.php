  <div class="modal">
    <a href="/"><button class="modal__close" type="button" name="button">Закрыть</button></a>

    <h2 class="modal__heading">Добавление задачи</h2>

    <form class="form"  action="index.php" method="post" enctype="multipart/form-data">
      <div class="form__row">      
        <? if (in_array('name', $errors)) {echo $error;}?>
        <label class="form__label" for="name">Название <sup>*</sup></label>

        <input class="form__input <? if (in_array('name', $errors)){echo $class_error;}?>" type="text" name="name" id="name" value="" placeholder="Введите название">
      </div>

      <div class="form__row">
        <? if (in_array('project', $errors)){echo $error;}?>
        <label class="form__label" for="project">Проект <sup>*</sup></label>

        <select class="form__input form__input--select <? if (in_array('project', $errors)){echo $class_error;}?>" name="project" id="project">
          <option value="Select category">---Выберите категорию---</option>
          <? foreach ($project_cats as $key => $value) :?>
                <?if (!$key == 0 ) :?>
          <option value="<? echo $value; ?>"><? echo $value; ?></option>
              <? endif;?> 
          <? endforeach; ?>
        </select>
      </div>

      <div class="form__row">
        <? if (in_array('date', $errors)){echo $error;}?>
        <label class="form__label" for="date">Дата выполнения</label>

        <input class="form__input form__input--date <? if (in_array('date', $errors)){echo $class_error;}?>" type="date" name="date" id="date" value="" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
      </div>

      <div class="form__row">
        <label class="form__label" for="preview">Файл</label>

        <div class="form__input-file">
          <input class="visually-hidden" type="file" name="preview" id="preview" value="">

          <label class="button button--transparent" for="preview">
              <span>Выберите файл</span>
          </label>
        </div>
      </div>

      <div class="form__row form__row--controls">
        <input class="button" type="submit" name="" value="Добавить">
      </div>
    </form>
  </div>