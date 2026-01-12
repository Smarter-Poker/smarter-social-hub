<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:_header.notifications.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf872a24_58932082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf282609f9369933f864295111efa8791b19935e' => 
    array (
      0 => '_header.notifications.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 1,
    'file:__feeds_notification.tpl' => 1,
  ),
))) {
function content_6964acdf872a24_58932082 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
?><li class="dropdown js_live-notifications">
  <a href="#" data-bs-toggle="dropdown" data-display="static">
    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"header-notifications",'class'=>"header-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
    <span class="counter red shadow-sm rounded-pill <?php if ($_smarty_tpl->getValue('user')->_data['user_live_notifications_counter'] == 0) {?>x-hidden<?php }?>">
      <?php echo $_smarty_tpl->getValue('user')->_data['user_live_notifications_counter'];?>

    </span>
  </a>
  <div class="dropdown-menu dropdown-menu-end dropdown-widget js_dropdown-keepopen">
    <div class="dropdown-widget-header">
      <span class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Notifications");?>
</span>

      <label class="switch sm float-end" for="notifications_sound">
        <input type="checkbox" class="js_notifications-sound-toggle" name="notifications_sound" id="notifications_sound" <?php if ($_smarty_tpl->getValue('user')->_data['notifications_sound']) {?>checked<?php }?>>
        <span class="slider round"></span>
      </label>
      <div class="float-end mr5">
        <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Sound");?>

      </div>
    </div>
    <div class="dropdown-widget-body">
      <div class="js_scroller">
        <?php if ($_smarty_tpl->getValue('user')->_data['notifications']) {?>
          <ul>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('user')->_data['notifications'], 'notification');
$foreach19DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('notification')->value) {
$foreach19DoElse = false;
?>
              <?php $_smarty_tpl->renderSubTemplate('file:__feeds_notification.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
          </ul>
        <?php } else { ?>
          <p class="text-center text-muted mt10">
            <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("No notifications");?>

          </p>
        <?php }?>
      </div>
    </div>
    <a class="dropdown-widget-footer" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/notifications"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("See All");?>
</a>
  </div>
</li><?php }
}
