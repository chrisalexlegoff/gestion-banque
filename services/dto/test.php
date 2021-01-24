<?php
try {
    $date = new DateTime('2000-13-13');
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}

echo $date->format('Y-m-d');
?>