<h4 class="text-dark">Список задач</h4>


<?php

$idOrd;
$order;

if ($this->order) {
  $idOrd = true;
  if ($this->order == 'DESC')
  {
    $order = 'ASC';
  }
} else {
  $idOrd = false;
  $order = 'DESC';
}

if ($this->pagg )
{
  $pagg = $this->pagg;
}
else
{
  $pagg = 0;
}

?>
<div class="btn-group d-flex justify-content-end" role="group" aria-label="Basic example">
  <a href="/?order=<?php echo $order . '&sort=username' . '&pagg=' . $pagg ?>" type="button" class="btn btn-info">По имени</a>
  <a href="/?order=<?php echo $order . '&sort=email' . '&pagg=' . $pagg ?>" type="button" class="btn btn-warning">По email</a>
  <a href="/?order=<?php echo $order . '&sort=isdo' . '&pagg=' . $pagg ?>" type="button" class="btn btn-success">По выполнению</a>
</div>


<?php
$i = 0;


foreach ($this->data as $li)
{

$i ++;
?>

<div class="card text-dark">
  <h5 class="card-header"><?php echo htmlspecialchars($li['username']) ?> </h5>

<div class="card-body">
  <h6 class="card-title"><a href="mailto:<?php echo htmlspecialchars($li['email']) ?>"><?php echo htmlspecialchars($li['email']) ?></a></h6>
  <p class="card-text"><?php echo htmlspecialchars($li['tasktext']) ?></p>
  <?php
  
  if ($_SESSION['admin']) 
  {
    ?>
      <a href="/change/<?php echo $li['id'] ?>" class="btn btn-primary">Редактировать</a>
    <?php
      if ($li['isdo'] != 1) 
      {
        ?>
        <button data-id="<?php echo $li['id'] ?>" class="btn btn-primary">Отметить как выполненное</button>
        <?php
      }
    
  }
  if ($li['isrewrite']) {
    ?>
    <div class="btn btn-secondary">Отредактировано администратором</div>
    <?php
  }
  if ($li['isdo'] == 1) {
    ?>
    <div class="btn btn-success">Выполнено</div>
    <?php
  } else {
    ?>
    <div class="btn btn-warning">Выполняется</div>
    <?php

  }
?>
</div>


</div>

<?php
}

if ($i < 1) {
  ?>
  <div class="card-body">
    <h5>Задач пока нет. Создайте первую!</h5>
  </div>
  <?
}

if ( $this->pagg > 0 ) {
  ?>

  <a href="/?<?php if ($idOrd) { echo 'order=' . $this->order . '&sort=' . $this->sort . '&' ; } ?>pagg=<?php echo $this->pagg - 1 ?>" class="btn btn-primary">Назад</a>


  <?php
  
}


if ( ($this->pagg + 1) * 3 < $this->count)
{

  ?>

  <a href="/?<?php if ($idOrd) { echo 'order=' . $this->order . '&sort=' . $this->sort . '&' ; } ?>pagg=<?php echo $this->pagg + 1 ?>" class="btn btn-primary">Вперёд</a>


  <?php
}


?>