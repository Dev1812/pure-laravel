<?php




function str_safety($string) {
return htmlspecialchars($string);
}

define('RESTORE_URL', 'http://kakio-enot.io/restore/change?token=');
  use Illuminate\Http\Request;
    
  define('SHORT_FIRST_NAME_LENGTH', 3);    
  define('LONG_FIRST_NAME_LENGTH', 70);

  define('SHORT_LAST_NAME_LENGTH', 3);    
  define('LONG_LAST_NAME_LENGTH', 70);   

  define('SHORT_LOGIN_LENGTH', 3);    
  define('LONG_LOGIN_LENGTH', 70);   

  define('SHORT_EMAIL_LENGTH', 3);    
  define('LONG_EMAIL_LENGTH', 70);   

  define('SHORT_PASSWORD_LENGTH', 3);    
  define('LONG_PASSWORD_LENGTH', 70);       


  define('SITE_NAME', 'Test');
  define('SITE_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']).'/');







function isUserAuth() {
 return !empty(session('user_id'));
}

function getRandomHash() {
  return hash('sha256', time().$_SERVER['REMOTE_ADDR'].md5(time()));
}
function getLang() {
  return 'ru';
}
function getIp() {
  return $_SERVER['REMOTE_ADDR'];
}
function makeSafetyString($string) {
return $string;
}

class Crypto {

  public function generateHash() {
    return hash_hmac('ripemd160', uniqid(), md5(time()));
  }    

  public function generateSalt($max_length = 7) {
    $max_length = intval($max_length);
    $hash = $this->generateHash();
    return substr($hash, 0, $max_length); 
  }   

  public function passwordHashing($password) {
    $salt = '$5$'.$this->generateSalt(11).'$'; // SHA-256
    $hashed_password = crypt($password, $salt);
    return array('hashed_password' => $hashed_password, 'salt' => $salt);
  }

  /**
   * @desc <string> hashed_password - Зашифрованный пароль
   * @desc <string> password        - Пароль, отправленный пользователем
   * @desc <string> salt            - Соль, например из базы данных
   *
   * @return <boolean> true           Если пароль + соль ==  хешированный пароль
   * @return <boolean> false          Если пароль + соль !=  хешированный пароль
   *
   */
  public function checkPassword($hashed_password, $password, $salt) {
    return (crypt($password, $salt) == $hashed_password) ? true : false;
  }


}
function getShortMonth($num) {
    if(!$num) return false;
    $short_months = array(
  1 => 'янв',
  2 => 'фев',
  3 => 'мар',
  4 => 'апр',
  5 => 'май',
  6 => 'июн',
  7 => 'июл',
  8 => 'авг',
  9 => 'сен',
  10 => 'окт',
  11 => 'ноя',
  12 => 'дек');
    if($num < 0 || $num > 12) {
      return false;
    }
    return $short_months[$num];
  }


   function parseTimestamp($ts) {
    if(!$ts || !is_numeric($ts)) return false;

  
    $ts_date = date('H:i j n Y', $ts);
    list($ts_time, $ts_day, $ts_month, $ts_year) = explode(' ', $ts_date);
 
    $date = date('j n Y');
    list($day, $month, $year) = explode(' ', $date);

    $yesterday = $day-1;

    if($year != $ts_year) {
      return $ts_day.' '.getShortMonth($ts_month).' '.$ts_year;//21 дек 2014
    } else {
      if($day == $ts_day) {
        return 'сегодня в '.$ts_time;//сегодня в 11:40
      } elseif($yesterday == $ts_day) { //вчера
        return 'вчера в '.$ts_time;//вчера в в 11:40
      } else {
        return $ts_day.' '.getShortMonth($ts_month).' в '.$ts_time;//9 дек в 14:32
      }
    }
  } 

  function connectDatabase($host = 'localhost', $user = 'root', $password = '', $db_name = 'bihoo') {
      return new PDO('mysql:host='.$host.';dbname='.$db_name, $user, $password);
    }
























/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
