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
  $viewPath = basePath("views\\" . $name . ".view.php");
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
  $partialPath = basePath("views\partials\\" . $name . ".php");
  if (file_exists($partialPath)) {
    require $partialPath;
  } else {
    echo "Partial '${name}' not found!";
  }
}

/**
 * Preformat text - will inspect a value(s)
 * 
 * @param mixed $value
 * @return void
 */
function pr($value) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
}

/**
 * Preformat text and exit
 * @param mixed $value
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
 * @param mixed $salary
 * @return string
 */
function formatSalary($salary) {
  return "$" . number_format(floatval($salary)); 
}