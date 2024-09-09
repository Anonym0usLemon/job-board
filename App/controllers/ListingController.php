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
    loadView('listings/index', [
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
  public function show($params)
  {

    $id = $params['id'] ?? '';
    $params = [
      'id' => $id
    ];
    $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

    // Check if listing exists
    if(!$listing) {
      ErrorController::notFound('Listing not found'); 
      return;
    }

    loadView('listings/show', [
      'listing' => $listing
    ]);
  }
}