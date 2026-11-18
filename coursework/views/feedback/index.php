<div class="welcome-row">
<div>
<div class="eyebrow purple">МЫ НА СВЯЗИ</div>
<h2>Обратная связь</h2>
<p class="muted">Есть идея или вопрос? Напиши сообщение.</p>
</div>
</div>
<form class="panel form-panel narrow-form" method="post" action="index.php?route=feedback-send">
<input type="hidden" name="_token" value="<?= e($_SESSION['_token']) ?>">
<label>Твоё имя<input required name="name" maxlength="120" placeholder="Как к тебе обращаться?">
</label>
<label>Электронная почта<input required type="email" name="email" maxlength="180" placeholder="name@example.com">
</label>
<label>Тема обращения<select name="topic">
<option>Вопрос</option>
<option>Предложение</option>
<option>Сообщение об ошибке</option>
<option>Благодарность</option>
</select>
</label>
<label>Сообщение<textarea required name="message" rows="6" placeholder="Напиши своё сообщение...">
</textarea>
</label>
<button class="btn primary">Отправить сообщение</button>
</form>
