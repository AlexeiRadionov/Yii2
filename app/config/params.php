<?php

return [
    'adminEmail' => 'admin@example.com',
    'dateFormat' => function($date) {
    	return date('d.m.Y H:i:s', strtotime($date));
    },
];
