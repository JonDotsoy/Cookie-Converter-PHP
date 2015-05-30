<?php

namespace cookieConverter;

class cookie {

  public $cookies  = [];
  public $extras   = [];
  public $expires  = false;
  public $path     = false;
  public $domain   = false;
  public $secure   = false;
  public $HttpOnly = false;


  public function __construct($string_cookies = "") {
    $this->converter_from_string($string_cookies);

  }

  public function __toString() {
    // return new \date(0);
    // $cookies;
    // $extras;
    // $expires;
    // $path;
    // $domain;
    // $secure;
    // $HttpOnly;
    $strReturn = [];

    foreach ($this->cookies as $name => $cookie) {
      if (isset($name) && $name != "") {
        $strReturn[] = $name . "=" . $cookie;
      }
    }

    if ($this->expires) {
      $strReturn[] = "Expires=" . gmdate('D, d M Y H:i:s T', $this->expires);
    }

    if ($this->path) {
      $strReturn[] = "Path=" . $this->path;
    }

    if ($this->domain) {
      $strReturn[] = "Domain=" . $this->domain;
    }

    if ($this->secure) {
      $strReturn[] = "Secure";
    }

    if ($this->HttpOnly) {
      $strReturn[] = "HttpOnly";
    }


    return implode("; ", $strReturn);
  }

  public function setExpires($line_time) {
    $this->expires = \strtotime($line_time);
  }

  /*****************************************************************************
  *****************************************************************************/


  private function converter_from_string($line_cookie) {
    /**
     * - cookieSet     : Crea valores de cookies
     * - cookieOptions : Crea parametros de las cookies
     */
    $statatusConverter = 'cookieSet';

    $parts = explode(";", $line_cookie);

    foreach ($parts as $keyPart => $part) {
      /* Delimita la parte de la cadena a un nombre y un valor. */
      $part_divide = explode('=', $part);

      $nameParameter  = trim($part_divide[0]);
      $valueParameter = trim(isset($part_divide[1]) ? $part_divide[1] : null);

      switch ($nameParameter) {
        case 'Domain':
          $statatusConverter = 'cookieOptions';
          $this->domain = $valueParameter;
          break;
        case 'Path':
          $statatusConverter = 'cookieOptions';
          $this->path = $valueParameter;
          break;
        case 'Expires':
          $statatusConverter = 'cookieOptions';
          $this->setExpires($valueParameter);
          break;
        case 'Secure':
          $statatusConverter = 'cookieOptions';
          $this->secure = true;
          break;
        case 'HttpOnly':
          $statatusConverter = 'cookieOptions';
          $this->HttpOnly = true;
          break;


        default:
          if ($statatusConverter == 'cookieSet') {
            $this->cookies[$nameParameter] = $valueParameter;
          } elseif ($statatusConverter == 'cookieOptions') {
            $this->extras[$nameParameter] = $valueParameter;
          }
          break;
      }

    }

  }

}
