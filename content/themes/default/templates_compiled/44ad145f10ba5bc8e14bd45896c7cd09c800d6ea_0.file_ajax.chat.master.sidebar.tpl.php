<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:16
  from 'file:ajax.chat.master.sidebar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964ace0b3bbc9_40358013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44ad145f10ba5bc8e14bd45896c7cd09c800d6ea' => 
    array (
      0 => 'ajax.chat.master.sidebar.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6964ace0b3bbc9_40358013 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sidebar_friends'), '_user');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('_user')->value) {
$foreach0DoElse = false;
?>
  <div class="chat-avatar-wrapper clickable js_chat-start" data-uid="<?php echo $_smarty_tpl->getValue('_user')['user_id'];?>
" data-name="<?php if ($_smarty_tpl->getValue('system')['show_usernames_enabled']) {
echo $_smarty_tpl->getValue('_user')['user_name'];
} else {
echo $_smarty_tpl->getValue('_user')['user_firstname'];?>
 <?php echo $_smarty_tpl->getValue('_user')['user_lastname'];
}?>" data-link="<?php echo $_smarty_tpl->getValue('_user')['user_name'];?>
" data-picture="<?php echo $_smarty_tpl->getValue('_user')['user_picture'];?>
" data-bs-toggle="tooltip" data-bs-placement="left" title="<?php if ($_smarty_tpl->getValue('system')['show_usernames_enabled']) {?> <?php echo $_smarty_tpl->getValue('_user')['user_name'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->getValue('_user')['user_firstname'];?>
 <?php echo $_smarty_tpl->getValue('_user')['user_lastname'];?>
 <?php }?>">
    <div class="chat-avatar">
      <img src="<?php echo $_smarty_tpl->getValue('_user')['user_picture'];?>
" alt="" />
      <i class="online-status fa fa-circle <?php if ($_smarty_tpl->getValue('_user')['user_is_online']) {?>online<?php } else { ?>offline<?php }?>"></i>
    </div>
    <?php if ($_smarty_tpl->getValue('system')['chat_status_enabled'] && !$_smarty_tpl->getValue('_user')['user_is_online']) {?>
      <div class="last-seen">
        <span class='js_moment' data-time='<?php echo $_smarty_tpl->getValue('_user')['user_last_seen'];?>
'><?php echo $_smarty_tpl->getValue('_user')['user_last_seen'];?>
</span>
      </div>
    <?php } else { ?>
      <div class="pb10"></div>
    <?php }?>
  </div>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
}
}
