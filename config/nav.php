<?php

return [
    [
        'icon' => 'nav-icon fas fa-alt',
        'title' => 'Home',
        'route' => 'dashboard',
        'active' => 'dashboard'
    ],
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'title' => 'Categories',
        'route' => 'categories.index',
        'active' => 'categories.*',
        'badge' => ''
    ],
    [
        'icon' => 'far fa-circle nav-icon',
        'title' => 'Products',
        'route' => 'dashboard',
        'active' => 'products.*',
    ],
];

?>