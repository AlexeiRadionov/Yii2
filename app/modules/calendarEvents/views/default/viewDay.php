<?php
    $this->title = 'Events today';
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents', 'label' => 'List events'];
    $this->params['breadcrumbs'][] = $this->title;
?>

<a class="btn btn-primary" href="/calendarEvents/default/form">Add event</a>
<hr>

<h4>Today: <?php echo date('d-m-Y') . " $day"?></h4>
<h4>Events today:</h4>
<hr>

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

        <a class="btn btn-danger" href="#">Delete</a>
        <?php echo'<a class="btn btn-info" href="/calendarEvents/default/form?id=' . $event['id_events'] . '">' ?>Edit</a>
    </div>
    <hr>
<?php endforeach; ?>