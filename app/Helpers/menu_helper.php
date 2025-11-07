<?php
if (!function_exists('is_active')) {
    function is_active($path) {
        $uri = service('uri');
        $current = trim($uri->getPath(),'/');
        $path = trim($path,'/');

        $current = str_replace('index.php/','',$current);

        return (strpos($current, $path) === 0) ? 'active' : '';
    }
}
