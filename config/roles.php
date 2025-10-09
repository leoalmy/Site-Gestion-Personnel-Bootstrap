<?php
return [
    'ROLE_GRAGAS' => [],
    'ROLE_MEMBRE' => [],
    'ROLE_EDITOR' => ['ROLE_MEMBRE'],
    'ROLE_ADMIN'  => ['ROLE_EDITOR'],
];
?>