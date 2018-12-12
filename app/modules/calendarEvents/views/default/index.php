<span>List events</span>
<span>/</span>
<a href="/calendarEvents/default/day">Events today</a>
<span>/</span>
<a href="/calendarEvents/default/form">Add event</a>
<div>
    <h1>My events</h1>

    <?php foreach ($eventsUser as $event): ?>
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
</div>