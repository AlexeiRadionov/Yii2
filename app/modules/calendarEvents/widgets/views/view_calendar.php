<?php
    $first = $date->modify('first day of this month');
    $firstDay = ($first->format('w') + 7) % 7;
    $totalDay = $first->format('t');
    $cellCount = ($firstDay + $totalDay + (7 - (($firstDay + $totalDay) % 7)));
    
    $eventsMonth = [];
    
    $calendarDate = strtotime(date('Y-m', strtotime($date->format('Y-m'))));
    
    foreach ($activities as $value) {
        foreach ($value as $item) {
            
            if (
                (strtotime(date('Y-m', strtotime($item['startDay']))) == $calendarDate
                || strtotime(date('Y-m', strtotime($item['endDay']))) == $calendarDate)
                || (strtotime(date('Y-m', strtotime($item['startDay']))) < $calendarDate
                && strtotime(date('Y-m', strtotime($item['endDay']))) > $calendarDate)
            ) {

                $count = date('Y-m-d', strtotime($item['startDay']));

                while (strtotime(date('Y-m', strtotime($count))) != $calendarDate) {

                    $count = date('Y-m-d', strtotime($count . '+1 days'));

                }
           
                while (strtotime($count) <= strtotime(date('Y-m-d', strtotime($item['endDay']))) && strtotime(date('Y-m', strtotime($count))) == $calendarDate) {
                    
                    $numberDay = (int)date('j', strtotime($count));
                    
                    $eventsMonth[][$numberDay] = [$item['title'], $item['id_events']];

                    $count = date('Y-m-d', strtotime($count . '+1 days'));
                }
            }
        }
    }
?>

<table class="table table-bordered">
    <tr>
        <th style="text-align: center;" colspan='7'>
            <a style="float: left;" href="/calendarEvents/default/month?month=prev">Prev</a>
            <?php echo $date->format('F Y'); ?>
            <a style="float: right;" href="/calendarEvents/default/month?month=next">Next</a>
        </th>
    </tr>
    <tr>
        <th>ПН</th>
        <th>ВТ</th>
        <th>СР</th>
        <th>ЧТ</th>
        <th>ПТ</th>
        <th>СБ</th>
        <th>ВС</th>
    </tr>
    
    <tr>
        <?php for($i = 1, $day = 1; $i <= $cellCount; $i ++): ?>
            
            <?php if ($calendarDate == strtotime(date('Y-m')) && $day == (int)date('j')): ?>
                
                <td style="vertical-align: bottom; border: 2px solid red;">

            <?php else: ?>
                <td style="vertical-align: bottom;">
            <?php endif; ?>
                
                <?php if( $i >= $firstDay && $day <= $totalDay ):?>
                    
                    <ul>
                        <?php foreach ($eventsMonth as $value): ?>

                            <?php foreach ($value as $key => $item): ?>
                            
                                <?php if($key == $day): ?>
                                               
                                    <li>
                                        <?php echo '<a href="/calendarEvents/events/view?id=' . $item[1] . '">' . $item[0]; ?></a>
                                    </li>
                                                   
                                <?php endif; ?>

                            <?php endforeach; ?>
                            
                        <?php endforeach; ?>
                    </ul>
                    
                    <?php  echo $day++; ?>
                <?php endif; ?>
            </td>

            <?php if($i % 7 == 0):?>
    </tr>
    <tr>
            <?php endif; ?>

        <?php endfor; ?>
    </tr>
</table>