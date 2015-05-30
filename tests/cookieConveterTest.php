<?php

// echo __DIR__."\n\n";
require __DIR__ . "/../src/cookieConverter/cookie.php";


use \cookieConverter\cookie;

class cookieConverterTest extends \PHPUnit_Framework_TestCase
{

  protected $string_cookie_a = "lu=Rg3vHJZnehYLjVg7qi3bZjzg; Expires=Tue, 15-Jan-2013 21:47:38 GMT; Path=/; Domain=.example.com; HttpOnly";
  protected $string_cookie_b = "made_write_conn=1295214458; Path=/; Domain=.example.com";
  protected $string_cookie_c = "reg_fb_gate=deleted; Expires=Thu, 01-Jan-1970 00:00:01 GMT; Path=/; Domain=.example.com; HttpOnly";
  protected $string_cookie_d = "SSID=123bcca; SOCIAL=FASEBOOK; A=4";

  public function __construct() {

    $this->cookiea = new cookie($this->string_cookie_a);
    $this->cookieb = new cookie($this->string_cookie_b);
    $this->cookiec = new cookie($this->string_cookie_c);
    $this->cookied = new cookie($this->string_cookie_d);

  }

  /**
   * Ingresa una cadena capturada de set-cookie http y la combierte en una cadena convertida con cookieConverter.
   */
  public function testStringCookieAStringCookie()
  {
    $this->assertEquals($this->cookiea, "lu=Rg3vHJZnehYLjVg7qi3bZjzg; Expires=Tue, 15 Jan 2013 21:47:38 GMT; Path=/; Domain=.example.com; HttpOnly");
    $this->assertEquals($this->cookieb, "made_write_conn=1295214458; Path=/; Domain=.example.com");
    $this->assertEquals($this->cookiec, "reg_fb_gate=deleted; Expires=Thu, 01 Jan 1970 00:00:01 GMT; Path=/; Domain=.example.com; HttpOnly");
    $this->assertEquals($this->cookied, "SSID=123bcca; SOCIAL=FASEBOOK; A=4");
  }

  /**
   * Compara los valores obtenidos de la cadena y la obtenida por cookieConverter.
   */
  public function testCorrectaCapturDeValores()
  {
    $this->assertArrayHasKey("lu", $this->cookiea->cookies);
    $this->assertArrayHasKey("made_write_conn", $this->cookieb->cookies);
    $this->assertArrayHasKey("reg_fb_gate", $this->cookiec->cookies);
    $this->assertArrayHasKey("SSID", $this->cookied->cookies);
    $this->assertArrayHasKey("SOCIAL", $this->cookied->cookies);
    $this->assertArrayHasKey("A", $this->cookied->cookies);
  }

  /**
   */
  public function testStringCookie()
  {
    $this->assertNotNull((string) $this->cookiea);
    $this->assertNotNull((string) $this->cookieb);
    $this->assertNotNull((string) $this->cookiec);
    $this->assertNotNull((string) $this->cookied);
  }

  public function testCountNumberDetectValues() {

    $this->assertCount(1, $this->cookiea->cookies);
    $this->assertCount(1, $this->cookieb->cookies);
    $this->assertCount(1, $this->cookiec->cookies);
    $this->assertCount(3, $this->cookied->cookies);

  }

}

