<?php
include SITE_ROOT.'/resources/views/tpl/head.blade.php';
include SITE_ROOT.'/resources/views/tpl/right_bar.blade.php';
 include SITE_ROOT.'/resources/views/tpl/sidebar.blade.php';

?>


<div class="content">
<style type="text/css">
.reg_page{padding: 37px 0}
</style>
<div class="reg_page">

<div class="form">
<div class="form_title">Регистрация</div>
<div class="form_body">

<FORM action="" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

<?php
if(!empty($result)) {
var_dump($result);
}
?>

<div class="form_section">
<div class="form_section_label">Ваше имя</div>
<div class="form_section_input_wrap">
<input type="text" class="big_text_field" placeholder="Ваше имя" name="reg_first_name">
</div>
</div>

<div class="form_section">
<div class="form_section_label">Ваша фамилия</div>
<div class="form_section_input_wrap">
<input type="text" class="big_text_field" placeholder="Ваша фамилия" name="reg_last_name">
</div>
</div>

<div class="form_section">
<div class="form_section_label">Ваш логин</div>
<div class="form_section_input_wrap">
<input type="text" class="big_text_field" placeholder="Ваш логин" name="reg_login">
</div>
</div>

<div class="form_section">
<div class="form_section_label">Ваш email</div>
<div class="form_section_input_wrap">
<input type="text" class="big_text_field" placeholder="Ваш email" name="reg_email">
</div>
</div>

<div class="form_section">
<div class="form_section_label">Ваш пароль</div>
<div class="form_section_input_wrap">
<input type="text" class="big_text_field" placeholder="Ваш пароль" name="reg_password">
</div>
</div>

<div class="form_section form_section_wrap">
<div class="form_section_input_wrap">
<input type="submit" class="button_blue" name="reg_submit" value="Зарегестрироваться">
</div>
</div>

</FORM>

</div>
</div>

</div>
  
</div>
<?php
include SITE_ROOT.'/resources/views/tpl/other.blade.php';
include SITE_ROOT.'/resources/views/tpl/footer.blade.php';
?>