<?php

require dirname(__DIR__) . '/bootstrap.php';

use Doctrine\ORM\EntityManager;


$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => ':memory:',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

return $entityManager;