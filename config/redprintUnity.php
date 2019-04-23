<?php
return [
    'page_title' => 'Redprint AB',
    'page_title_prefix' => null,
    'page_title_postfix' => null,
    'powered_by' => '&copy; Redprint by Intelle Hub Inc.',

    'menu' => array_merge(
        function_exists('redprintMenu') ? redprintMenu() : [],
        function_exists('permissibleMenu') ? permissibleMenu() : [],
        array_merge(['Backend'], include(config_path('/backend_menu.php')))
    ),

    'skin' => 'elegant-white', // available skins: blue, purple
    'logo' => 'vendor/redprintUnity/img/redprint_light_bg.png',
    'profile_bg' => 'vendor/redprintUnity/img/profile-bg.jpg',
    'login_bg' => 'vendor/redprintUnity/img/profile-bg.jpg',
    'default_avatar' => 'vendor/redprintUnity/img/user.png',
    'auth_user_avatar_field' => null,
    
    // Routes
    'login_post_route' => 'backend.login.post',
    'logout_route' => 'backend.logout',
    'dashboard_route' => 'backend.dashboard',
    'profile_route' => 'backend.profile',
    
    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */
   
    'filters' => [
        Shahnewaz\RedprintUnity\Menu\Filters\HrefFilter::class,
        Shahnewaz\RedprintUnity\Menu\Filters\ActiveFilter::class,
        Shahnewaz\RedprintUnity\Menu\Filters\SubmenuFilter::class,
        Shahnewaz\RedprintUnity\Menu\Filters\ClassesFilter::class,
        Shahnewaz\RedprintUnity\Menu\Filters\GateFilter::class,
    ]
];
