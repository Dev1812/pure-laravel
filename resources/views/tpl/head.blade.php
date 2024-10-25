
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="/css/main.css?<?php echo rand();?>">
  <title></title>
</head>
<body id="body" class="dark_theme">

<div id="wrap1">

<div class="wrap2">





  
<div class="head" id="head_mobile">
<div class="head_wrap">

<?php
if(isUserAuth()) {
?>

<div class="head_right">
  <a href="/search">
<span class="icon head_search_action_button"></span></a>
</div>
<?php
} else {
?>
<div class="head_right">
<a href="/login" class="head_item">Вход</a>
<a href="/reg" class="head_item">Регистрация</a>
</div>  
<?php
}
?>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script type="text/javascript">
  
function showSidebar() {

  $('#layer-gray__sidebar').fadeIn();
  $('#sidebar_mobile').fadeIn();

$('#head_mobile').fadeIn();
$('#sidebar_mobile').fadeIn();
}

  
function hideSidebar() {

  $('#layer-gray__sidebar').fadeOut();
  $('#sidebar_mobile').fadeOut();

}





















































//var is_weather_active = '<?php echo session('is_weather_active');?>';
if(localStorage.getItem('is_weather_active')!=='false') {

  $('#body').removeClass('dark_theme');
  }
  function switchWeather() {
  var is_weather_active = localStorage.getItem('is_weather_active');

  if(is_weather_active=='true') {
    
  $('#body').addClass('dark_theme');
  localStorage.setItem('is_weather_active', 'false');
  } else {
  $('#body').removeClass('dark_theme');
  localStorage.setItem('is_weather_active', 'true');

}

}






































</script>

<div class="head_center">
<div href="/reg" class=" head-logo"></div>
</div>
<div class="head_left">
<div class="head_item" onClick="showSidebar();"><i class="icon icon-menu"></i></div>
</div>
</div>
</div>

<div class="block_arrow_right_top" style="padding: 0;display: fnone;z-index: 191;display: none;" id="block_arrow_right_top_head_sidebar">
  <div> 
    <div>
      

      <div class="head_right" style="float: none;padding: 3px 11px 9px;">
<span class="icon cover_photo head_user_photo" style="background-image:url('/public/upload/c1/13245.jpg')"></span>


<span class="head_itdem" style="line-height: normal!important;height: auto!important;margin-bottom: 19px;">sfafs</span>
</div>

    </div>
    <div style="padding:3px 11px 9px;"><a style="display:block;color: #FFF;" href="/setting">Настройки</a><a style="display:block;color: #FFF;margin-top: 5px  ;" href="/logout">Выход</a></div>
  </div>
</div>
  
<div class="head" id="head_desktop">
<div class="head_wrap">

<?php
if(isUserAuth()) {
?>

<div class="head_right">
  <i class="icon icon_weather" onClick="switchWeather();"></i>
<span class="" onClick="$('#block_arrow_right_top_head_sidebar').fadeIn();$('#layer-gray__head_side_bar').fadeIn();">
<span class="icon cover_photo head_user_photo" style="background-image:url('<?php echo session('user_small_photo');?>')"></span>


<span class="head_item" style="border:0!important"><?php echo session('user_first_name');?></span></span>
</div>
<?php
} else {
?>
<div class="head_right">
<a href="/login" class="head_item">Вход</a>
<a href="/reg" class="head_item">Регистрация</a>
</div>  
<?php
}
?>


<div class="head_center">
  <FORM action="/search" method="GET">
  <input type="text" name="q" class="small_text_field head_search_field" placeholder="Поиск...">
  <input type="submit" name="submit" class="submit_solid" value=" " style="left: -37px;position: relative;cursor: pointer;">
</FORM>
</div>
<div class="head_left">
<a href="" class="head_item"><i class="icon icon_black_small"></i></a>
</div>
</div>
</div>    