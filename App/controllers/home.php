<?php 
use Framework\Database;

$config = require basePath('config/db.php');
$db = new Database($config); 

$params = [];

$listings = $db->query('SELECT * FROM listings LIMIT 6', $params)->fetchAll();



loadView('home', [
  'listings' => $listings,
]); 