<?php

return [
    '~^$~' =>                       [\Kernel\Controllers\MainController::class, 'main'],
    '~^csv/add~' =>                 [\Kernel\Controllers\DataController::class, 'add'],
    '~^data/(\d+)$~' =>             [\Kernel\Controllers\DataController::class, 'view'],
    '~^data/(\d+)/edit$~' =>        [\Kernel\Controllers\DataController::class, 'edit'],
    '~^data/(\d+)/delete$~' =>      [\Kernel\Controllers\DataController::class, 'delete'],
    
];