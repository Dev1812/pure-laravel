
<div class="sidebar" id="sidebar_mobile" style="display: none;"	>
  
<div class="sidebar_wrap">
  
<div class="sidebar_user_bar">
<div class="sidebar_user_photo cover_photo" style="background-image:url('<?php echo session('user_small_photo');?>');"></div>
<a class="sidebar_item__user_first_name sidebar_item" href=""><?php echo session('user_first_name');?> </a>  
</div>

<div class="sidebar_body">
<a class="sidebar_item" href="/photo">Фото</a> 
<a class="sidebar_item" href="/search">Люди</a>  
<a class="sidebar_item" href="/my_like">Лайки</a>  
<a class="sidebar_item" href="/i_following">Подписки</a>  
<a class="sidebar_item" href="/setting">Настройки</a>  
<a class="sidebar_item" href="/logout">Выход</a>  
</div>

</div>

</div>












<div class="sidebar" id="sidebar_desktop" style="displa">
  
<div class="sidebar_wrap">
  
 <a href="/id<?php echo session('user_id');?>">
<div class="sidebar_user_bar">
<div class="sidebar_user_photo cover_photo" style="background-image:url('<?php echo session('user_small_photo');?>');"></div>
<a class="sidebar_item__user_first_name sidebar_item" href=""><?php echo session('user_first_name');?> </a>  
</div>
</a>
<div class="sidebar_body">
<a class="sidebar_item" href="/photo">Фото</a> 
<a class="sidebar_item" href="/search">Люди</a>  
<a class="sidebar_item" href="/my_like">Лайки</a>  
<a class="sidebar_item" href="/i_following">Подписки</a>  
<a class="sidebar_item" href="/setting">Настройки</a>  
<a class="sidebar_item" href="/logout">Выход</a>   
</div>

</div>

</div>