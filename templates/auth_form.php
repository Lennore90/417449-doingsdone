<div class="modal">
	<a href="/"><button class="modal__close" type="button" name="button">Закрыть</button></a>
	<h2 class="modal__heading">Вход на сайт</h2>
	<form class="form" action="index.html" method="post">
		<div class="form__row">
			<label class="form__label" for="email">E-mail <sup>*</sup></label>
			<input class="form__input <?if (isset($_POST['email'])&&filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {echo $class_error;}?>" type="text" name="email" id="email" value="" placeholder="Введите e-mail">
			<? if (isset($_POST['email'])&&filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)):?>
				<p class="form__message">E-mail введён некорректно</p>
			<? endif; ?>
		</div>
		<div class="form__row">
			<label class="form__label" for="password">Пароль <sup>*</sup></label>
			<input class="form__input" type="password" name="password" id="password" value="" placeholder="Введите пароль">
		</div>
		<div class="form__row form__row--controls">
			<a href="/php-doingsdone"><input class="button" type="submit" name="" value="Войти"></a>
		</div>
	</form>
</div>