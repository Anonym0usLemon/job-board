<?php
namespace App\Controllers;
use Framework\Database;
use Framework\Validation;
use Framework\Session; 

class UserController
{
  protected $db;

  public function __construct()
  {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }

  /**
   * Show the login page
   * 
   * @return void
   */
  public function login()
  {
    loadView('users/login');
  }

  /**
   * Show the register page
   * 
   * @return void
   */
  public function create()
  {
    loadView('users/create');
  }

  /**
   * Store user in database 
   * 
   * @return void
   */
  public function store()
  {
    $errors = [];

    // Validation 
    if (!Validation::email($_POST['email'])) {
      $errors['email'] = 'Please enter a valid email address';
    }
    if (!Validation::string($_POST['name'], 2, 50)) {
      $errors['name'] = 'Name must be between 2 and 50 characters';
    }
    if (!Validation::string($_POST['password'], 6, 50)) {
      $errors['password'] = 'Password must be at least 6 characters';
    }
    if (!Validation::match($_POST['password'], $_POST['password_confirmation'])) {
      $errors['password_confirmation'] = 'Passwords do not match';
    }

    // Reload the view with error flash messages and exit
    if (!empty($errors)) {
      loadView('users/create', [
        'errors' => $errors,
        'user' => [
          'name' => $_POST['name'],
          'email' => $_POST['email'],
          'city' => $_POST['city'],
          'state' => $_POST['state']
        ]
      ]);
      exit;
    }

    // If validation passses... 
    // Check to see if the user already exists in the database
    $params = [
      'email' => $_POST['email']
    ];

    $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

    if ($user) {
      $errors['email'] = "That email already exitsts";
      loadView('users/create', [
        'errors' => $errors,
        'user' => [
          'name' => $_POST['name'],
          'email' => $_POST['email'],
          'city' => $_POST['city'],
          'state' => $_POST['state']
        ]
      ]);
      exit;
    }

    // Create user account
    $params = [
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'city' => $_POST['city'],
      'state' => $_POST['state'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ];

    $this->db->query('INSERT INTO users (name, email, city, state, password)
    VALUES (:name, :email, :city, :state, :password)', $params);

    // Get new user ID
    $userId = $this->db->conn->lastInsertId(); 

    Session::set('user', [
      'id' => $userId,
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'city' => $_POST['city'],
      'state' => $_POST['state'],
    ]);

    redirect('/');
  }

  /**
   * Logout user and kill session 
   * 
   * @return void
   */
  public function logout() {
    Session::clearAll(); 

    $params = session_get_cookie_params(); 
    setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);
    redirect('/');
  }

}