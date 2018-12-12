<a href="/calendarEvents">List events</a>
<span>/</span>
<span>Events to day</span>
<h4>Today: <?php echo date('d-m-Y') . " $day"?></h4>
<p>Events today:</p>
<?php foreach ($eventsDay as $event): ?>
	<div>
        <h3>
            <?php echo'<a title="Edit event" href="/calendarEvents/default/form?id=' . $event['id_events'] . '">' ?>
                <?php echo $event['title'] ?>
            </a>
        </h3>
        <p>Start date: <?php echo $event['startDay'] ?></p>
        <p>End date: <?php echo $event['endDay'] ?></p>
        <h4>Description</h4>
        <p><?php echo $event['description'] ?></p>
        <p><?php echo ($event['isBlock'] == 0)?"is block: no":"is block: yes";
             ?></p>
    </div>
    <hr>
<?php endforeach; ?>