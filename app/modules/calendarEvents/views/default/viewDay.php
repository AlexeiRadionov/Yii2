<p>Сегодня: <?php echo date('Y-m-d') . " $day"?></p>
<p>События на сегодня:</p>
<?php foreach ($eventsDay as $event): ?>
	<div>
        <h3><?php echo $event -> title ?></h3>
        <p><?php echo $event -> startDay . ' - ' . $event -> endDay ?></p>
        <p><?php echo $event -> description ?></p>
    </div>
    <hr>
<?php endforeach; ?>