<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:_user_menu.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf87fc65_48920487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59943d35a9bfa4aed531e6d22a1d768d8019462e' => 
    array (
      0 => '_user_menu.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 13,
  ),
))) {
function content_6964acdf87fc65_48920487 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
?><a href="#" class="dropdown dropdown-toggle user-menu" data-bs-toggle="dropdown" data-display="static">
  <img src="<?php echo $_smarty_tpl->getValue('user')->_data['user_picture'];?>
">
  <div class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Menu");?>
</div>
</a>
<div class="dropdown-menu <?php if ($_smarty_tpl->getValue('_as_widget')) {?>dropdown-widget<?php }?> dropdown-menu-end">
  <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/<?php echo $_smarty_tpl->getValue('user')->_data['user_name'];?>
">
    <img class="rounded-circle mr10" src="<?php echo $_smarty_tpl->getValue('user')->_data['user_picture'];?>
" width="20px" height="20px">
    <span><?php echo $_smarty_tpl->getValue('user')->_data['user_fullname'];?>
</span>
  </a>
  <?php if ($_smarty_tpl->getValue('system')['switch_accounts_enabled']) {?>
    <div class="dropdown-item pointer" data-toggle="modal" data-url="#account-switcher">
      <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"accounts_switcher",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
      <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Switch Accounts");?>

    </div>
  <?php }?>
  <div class="dropdown-divider"></div>
  <?php if ($_smarty_tpl->getValue('system')['packages_enabled'] && !$_smarty_tpl->getValue('user')->_data['user_subscribed']) {?>
    <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/packages">
      <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"membership",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
      <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Upgrade to Pro");?>

    </a>
  <?php }?>
  <?php if ($_smarty_tpl->getValue('system')['points_enabled'] || $_smarty_tpl->getValue('system')['wallet_enabled']) {?>
    <?php if ($_smarty_tpl->getValue('system')['points_enabled']) {?>
      <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/settings/points">
        <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"points",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
        <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Points");?>
: <span class="badge bg-light text-primary"><?php echo $_smarty_tpl->getValue('user')->_data['user_points'];?>
</span>
      </a>
    <?php }?>
    <?php if ($_smarty_tpl->getValue('system')['wallet_enabled']) {?>
      <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/wallet">
        <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"wallet",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
        <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Wallet");?>
: <span class="badge bg-light text-primary"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('print_money')($_smarty_tpl->getValue('user')->_data['user_wallet_balance']);?>
</span>
      </a>
    <?php }?>
    <div class="dropdown-divider"></div>
  <?php }?>

  <?php if ($_smarty_tpl->getValue('system')['support_center_enabled']) {?>
    <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/support">
      <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"support",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
      <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Support Center");?>

    </a>
    <div class="dropdown-divider"></div>
  <?php }?>

  <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/settings<?php if ($_smarty_tpl->getValue('detect')->isMobile()) {?>?show_categories<?php }?>">
    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"settings",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Settings");?>

  </a>
  <?php if ($_smarty_tpl->getValue('user')->_is_admin) {?>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/admincp">
      <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"admin_panel",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
      <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Admin Panel");?>

    </a>
  <?php } elseif ($_smarty_tpl->getValue('user')->_is_moderator) {?>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/modcp">
      <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"admin_panel",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Moderator Panel");?>

    </a>
  <?php }?>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/signout/?cache=<?php echo $_smarty_tpl->getValue('secret');?>
" onclick="localStorage.clear();">
    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"logout",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Sign Out");?>

  </a>
  <div class="dropdown-divider"></div>
  <div class="dropdown-item pointer d-none d-lg-block" data-toggle="modal" data-url="#keyboard-shortcuts">
    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"keyboard",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
    <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Keyboard Shortcuts");?>

  </div>
  <?php if ($_smarty_tpl->getValue('system')['themes'] && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('system')['themes']) > 1) {?>
    <div class="dropdown-item pointer" data-toggle="modal" data-url="#theme-switcher">
      <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"themes_switcher",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
      <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Theme Switcher");?>

    </div>
  <?php }?>
  <?php if ($_smarty_tpl->getValue('system')['system_theme_mode_select']) {?>
    <?php if ($_smarty_tpl->getValue('system')['theme_mode_night']) {?>
      <div class="dropdown-item pointer js_theme-mode" data-mode="day">
        <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"dark_light",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
        <span class="js_theme-mode-text"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Day Mode");?>
</span>
      </div>
    <?php } else { ?>
      <div class="dropdown-item pointer js_theme-mode" data-mode="night">
        <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"dark_light",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
        <span class="js_theme-mode-text"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Night Mode");?>
</span>
      </div>
    <?php }?>
  <?php }?>
</div><?php }
}
