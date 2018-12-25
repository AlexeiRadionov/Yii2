<?php
    $this->title = 'List events';
    $this->params['breadcrumbs'][] = $this->title;
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/default/day', 'label' => 'Events today'];
    $this->params['breadcrumbs'][] = ['url' => '/calendarEvents/user', 'label' => 'Users'];
?>

<a class="btn btn-primary" href="/calendarEvents/default/form">Add event</a>
<hr>

<div>
    <h1>My events</h1>

    <?php foreach ($eventsUser as $event): ?>
        <div>
            <h3>
                <?php echo'<a title="Edit event" href="/calendarEvents/default/form?id=' . $event['id_events'] . '">' ?>
                    <?php echo $event['title']; ?>
                </a>
            </h3>
            
            <p>Start date: <?php echo date($date, strtotime($event['startDay'])); ?></p>
            <p>Start date: <?php echo date($date, strtotime($event['endDay'])); ?></p>
            
            <h4>Description</h4>
            
            <p><?php echo $event['description']; ?></p>
            <p><?php echo ($event['isBlock'] == 0)?"is block: no":"is block: yes";
             ?></p>

            <h4>Creator: <?php echo $event -> user -> username; ?></h4>
            
            <a class="btn btn-danger" href="#">Delete</a>
            <?php echo'<a class="btn btn-info" href="/calendarEvents/default/form?id=' . $event['id_events'] . '">'; ?>Edit</a>
        </div>
        <hr>
    <?php endforeach; ?>
</div>