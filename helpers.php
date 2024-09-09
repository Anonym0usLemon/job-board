<?php 

/**
 * Get the base path
 * 
 * @param string path
 * @return string
 * 
 */
function basePath($path = '') {
  return __DIR__ . '\\' . $path;
}

/**
 * Load a view
 * 
 * @param string $name
 * @return void
 * 
 */
function loadView($name, $data = []) {
  $viewPath = basePath("App\\views\\" . $name . ".view.php");
  if (file_exists($viewPath)) {
    extract($data); // Makes array keys in $data available as varaibles
    require $viewPath;
  } else {
    echo "View '${name}' not found!";
  }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 * 
 */
function loadPartial($name) {
  $partialPath = basePath("App\\views\partials\\" . $name . ".php");
  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "Partial '${name}' not found!";
  }
}

/**
 * Preformat text - will inspect a value(s)
 * 
 * @param string $value
 * @return void
 */
function pr($value) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
}

/**
 * Preformat text and exit
 * 
 * @param string $value
 * @return void
 */
function pre($value) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
  die();
}

/**
 * Format salary
 * 
 * @param string $salary
 * @return string
 */
function formatSalary($salary) {
  return "$" . number_format(floatval($salary)); 
}

/**
 * Sanitize data 
 * 
 * @param string $dirty
 * @return string
 */
function sanitize($dirty) {
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Redirect to a given URL
 * 
 * @param string $url
 * @return void
 */
function redirect($url) {
  header('Location: ' . $url);
}