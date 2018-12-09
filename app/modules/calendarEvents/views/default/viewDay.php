<a href="/calendarEvents">List events</a>
<span>/</span>
<span>Events to day</span>
<h4>Today: <?php echo date('d-m-Y') . " $day"?></h4>
<p>Events today:</p>
<?php foreach ($eventsDay as $event): ?>
	<div>
        <h3><a href="/calendarEvents/default/form" title="Edit event"><?php echo $event -> title ?></a></h3>
        <p><?php echo $event -> startDay . ' - ' . $event -> endDay ?></p>
        <p><?php echo $event -> description ?></p>
    </div>
    <hr>
<?php endforeach; ?>