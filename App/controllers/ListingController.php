<?php

namespace App\Controllers;
use Framework\Database;

class ListingController
{
  protected $db;

  public function __construct()
  {
    // Connect to database when controller is accessed
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  /**
   * Show all listings
   * 
   * @return void
   */
  public function index()
  {
    $params = [];
    $listings = $this->db->query('SELECT * FROM listings', $params)->fetchAll();
    loadView('home', [
      'listings' => $listings,
    ]);
  }

  /**
   * Show create listing form
   * 
   * @return void
   */
  public function create()
  {
    loadView('listings/create');
  }

  /**
   * Show listing details
   * 
   * @return void
   */
  public function show()
  {

    $id = $_GET['id'] ?? '';
    $params = [
      'id' => $id
    ];
    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
    loadView('listings/show', [
      'listing' => $listing
    ]);
  }
}