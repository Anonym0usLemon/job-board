<?php

namespace App\Controllers;

class ErrorController
{
  protected $db;

  // Methods are static so that you don't need to instantiate a new Error object each time there's an error

  /**
   * 404 not found error
   * 
   * @return void
   */
  public static function notFound($message = 'Resource not found')
  {
    http_response_code(404);
    loadView('error', [
      'status' => '404',
      'message' => $message
    ]);
  }

  /**
   * 403 not found error
   * 
   * @return void
   */
  public static function unauthorized($message = 'You are not authorized to view this resource')
  {
    http_response_code(403);
    loadView('error', [
      'status' => '403',
      'message' => $message
    ]);
  }
}