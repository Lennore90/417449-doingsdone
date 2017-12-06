<div class="modal">
	<a href="/"><button class="modal__close" type="button" name="button">Закрыть</button></a>
	<h2 class="modal__heading">Вход на сайт</h2>
	<form class="form" action="index.php" method="post">
		<div class="form__row">
			<label class="form__label" for="email">E-mail <sup>*</sup></label>
			<? if (in_array('email', $notAuser)){echo $error;}?>
			<input class="form__input <?if ((isset($_POST['email'])&&(!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL))||(in_array('email', $notAuser)))) {echo $class_error;}?>" type="text" name="email" id="email" value="<? if (isset($_POST['email'])){echo $_POST['email'];}?>" placeholder="Введите e-mail">
			<? if ((isset($_POST['email']))&&(!filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL))):?>
				<p class="form__message">E-mail введён некорректно</p>
			<? elseif ((isset($_POST['email']))&&(searchUser($_POST['email'], $users) == null)):?>
				<p class="form__message">Пользователь не найден</p>
			<? endif; ?>
		</div>
		<div class="form__row">
			<label class="form__label" for="password">Пароль <sup>*</sup></label>
			<? if (isset($_POST['email'])&&!isset($_POST['password'])){echo $error;}?>
			<input class="form__input <? if ((in_array('password', $notAuser))) {echo $class_error;}?>" type="password" name="password" id="password" value="" placeholder="Введите пароль">
			<? if ((isset($_POST['password']))&&(!in_array($_POST['password'], searchUser($_POST['email'], $users)))):?>
				<p class="form__message">Пароль введен неверно</p>
			<? endif; ?>
		</div>
		<div class="form__row form__row--controls">
			<a href="/php-doingsdone"><input class="button" type="submit" name="" value="Войти"></a>
		</div>
	</form>
</div>