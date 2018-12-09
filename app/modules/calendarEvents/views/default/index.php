<span>List events</span>
<span>/</span>
<a href="/calendarEvents/default/day">Events today</a>
<span>/</span>
<a href="/calendarEvents/default/form">Add event</a>
<div>
    <h1>My events</h1>

    <?php foreach ($eventsUser as $event): ?>
        <div>
            <h3><a href="/calendarEvents/default/form" title="Edit event"><?php echo $event -> title ?></a></h3>
            <p><?php echo $event -> startDay . ' - ' . $event -> endDay ?></p>
            <p><?php echo $event -> description ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
</div>