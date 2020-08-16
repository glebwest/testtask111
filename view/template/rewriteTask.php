<?php

?>

<form class="active" id="loginForm" data-method="<?php if ($itsRewrite) { echo 'rewrite'; } else { echo 'newTask'; } ?>" data-pagg="<?php echo $this->pagg ?>">
<div class="form-group">
    <label for="exampleInputEmail1">Имя пользователя</label>
    <input <? if ($itsRewrite) { ?> value="<? echo htmlspecialchars($this->data['username']) ?>" disabled <? } ?> type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Имя пользователя">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Электронная почта</label>
    <input <? if ($itsRewrite) { ?> value="<? echo htmlspecialchars($this->data['email']) ?>" disabled <? } ?> type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Текст задачи</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"><? if ($itsRewrite) { echo htmlspecialchars($this->data['tasktext']); } ?> </textarea>
  </div>
  <button type="submit" class="btn btn-primary"><? if ($itsRewrite) { ?> Сохранить <? } else { ?> Добавить задачу  <?} ?> </button>

</form>


<div class="spin">
    <svg class="spinner" viewBox="0 0 50 50">
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
    </svg>
</div>
