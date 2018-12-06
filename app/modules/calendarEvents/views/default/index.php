<div>
    <h1>My events</h1>

    <?php foreach ($events as $event): ?>
        <div>
            <h3><?php echo $event -> title ?></h3>
            <p><?php echo $event -> startDay . ' - ' . $event -> endDay ?></p>
            <p><?php echo $event -> description ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
</div>