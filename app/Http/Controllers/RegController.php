<?php 
namespace App\Http\Controllers;
use DB;
use Crypto;
use Lang;
use Log;
class RegController extends Controller {
//!TODO is i nor reg


public function __contruct() {

}

  public function reg() {
/*
if(isUserAuth()) {
  return redirect('/photo');
}
*/
  if(empty($_POST['reg_submit'])) {
    return view('reg.reg');
  } else {
    $first_name = makeSafetyString($_POST['reg_first_name']);
    $last_name = makeSafetyString($_POST['reg_last_name']);
    $email = makeSafetyString($_POST['reg_email']);
    $login = makeSafetyString($_POST['reg_login']);
    $password = makeSafetyString($_POST['reg_password']);

  /*
    $first_name = makeSafetyString('uiuiui');
    $last_name = makeSafetyString('sadasd');
    $email = makeSafetyString('remsaisl@mail.ru');
    $login = makeSafetyString('addaddd');
    $password = makeSafetyString('rpassword');
  */
    $first_name_length = mb_strlen($first_name);
    $last_name_length = mb_strlen($last_name);
    $email_length = mb_strlen($email);
    $login_length = mb_strlen($login);
    $password_length = mb_strlen($password);
    if($first_name_length < SHORT_FIRST_NAME_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>3,'error_message'=>Lang::get('messages.short_firstname')),'status'=>'error')]);
    } else if($first_name_length > LONG_FIRST_NAME_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>4,'error_message'=>Lang::get('messages.long_firstname')),'status'=>'error')]);
    } else if(preg_match("/[^a-zA-Zа-яА-Я]/u",$first_name)) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'first_name', 'is_error'=>true,'error'=>array('error_code'=>5,'error_message'=>Lang::get('messages.incorrect_first_name')),'status'=>'error')]);
    }

    if($last_name_length < SHORT_LAST_NAME_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'last_name','is_error'=>true,'error'=>array('error_code'=>6,'error_message'=>Lang::get('messages.short_lastname')),'status'=>'error')]);
    } else if($last_name_length > LONG_LAST_NAME_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'last_name','is_error'=>true,'error'=>array('error_code'=>7,'error_message'=>Lang::get('messages.long_lastname')),'status'=>'error')]);
    } else if(preg_match("/[^a-zA-Zа-яА-Я]/u",$last_name)) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'last_name', 'is_error'=>true,'error'=>array('error_code'=>8,'error_message'=>Lang::get('messages.incorrect_last_name')),'status'=>'error')]);
    }

    if($login_length < SHORT_LOGIN_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'login','is_error'=>true,'error'=>array('error_code'=>9,'error_message'=>Lang::get('messages.short_login')),'status'=>'error')]);
    } else if($login_length > LONG_LOGIN_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'login','is_error'=>true,'error'=>array('error_code'=>10,'error_message'=>Lang::get('messages.long_login')),'status'=>'error')]);
    } else if(!preg_match("/^[a-zA-Zа-яА-Я0-9+_@.-]*$/u",$login)) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'login', 'is_error'=>true,'error'=>array('error_code'=>11,'error_message'=>Lang::get('messages.incorrect_login')),'status'=>'error')]);
    }

    if($email_length < SHORT_EMAIL_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>12,'error_message'=>Lang::get('messages.short_email')),'status'=>'error')]);
    } else if($email_length > LONG_EMAIL_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>13,'error_message'=>Lang::get('messages.long_email')),'status'=>'error')]);
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'email','is_error'=>true,'error'=>array('error_code'=>14,'error_message'=>Lang::get('messages.incorrect_email')),'status'=>'error')]);
    }

    if($password_length < SHORT_PASSWORD_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>15,'error_message'=>Lang::get('messages.short_password')),'status'=>'error')]);
    } else if($password_length > LONG_PASSWORD_LENGTH) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('error_field'=>'password','is_error'=>true,'error'=>array('error_code'=>16,'error_message'=>Lang::get('messages.long_password')),'status'=>'error')]);
    }



    $is_email_registered = DB::table('users')->where('email', $email)->get();
    $is_email_registered = json_decode(json_encode($is_email_registered), true);

    if(!empty($is_email_registered['id'])) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('is_error'=>true,'error'=>array('error_code'=>1,'error_message'=>  Lang::get('messages.user_registered')), 'status'=>'error','is_cover_background'=>true)]);
    }

    $is_login_registered = DB::table('users')->where('login', $login)->get();
    $is_login_registered = json_decode(json_encode($is_login_registered), true);

    if(!empty($is_login_registered[0]['id'])) {
      return view('reg.reg', ['is_cover_background'=>true,'result'=>array('is_error'=>true,'error'=>array('error_code'=>2,'error_message'=>Lang::get('messages.login_exist')),'status'=>'error','is_cover_background'=>true)]);
    }

    $this->crypto = new Crypto;
    $password_hashing = $this->crypto->passwordHashing($password);
    $hashed_password = $password_hashing['hashed_password'];  
    $salt = $password_hashing['salt'];

    $timestamp_registered = time();
    $reg_ip = getIp();
    $user_hash = getRandomHash();
    $lang=getLang();

    $reg_id = DB::table('users')->insertGetId(array(
  'id'=>NULL, 
  'first_name'=>$first_name, 
  'last_name'=>$last_name, 
  'email'=>$email, 
  'login'=>$login,   'salt'=>$salt,
  'hashed_password'=>$hashed_password, 
  'reg_ip'=>$reg_ip, 
  'lang'=>$lang, 
  'bio'=>'', 
  '50_photo'=>'', 
  '400_photo'=>'',  
  'orig_photo'=>'', 
  'is_banned'=>'false', 
  'ban_timestamp'=>'-1', 
  'hash'=>$user_hash, 
  'burth_timestamp'=>'-1', 
  'sex'=>'', 
  'parent_id'=>'-1',
  'reg_timestamp'=>$timestamp_registered,
  'phone_number'=>'',
  'time_reg'=>time()
    ));
    session(['user_id'=>$reg_id]);
    session(['user_first_name'=>$first_name]);
    session(['user_last_name'=>$last_name]);
    session(['user_login'=>$login]);
    session(['user_email'=>$email]);
    Log::notice($reg_id);
    return redirect('/');
    return view('reg.reg', ['is_cover_background'=>true]);
  }

  }

}