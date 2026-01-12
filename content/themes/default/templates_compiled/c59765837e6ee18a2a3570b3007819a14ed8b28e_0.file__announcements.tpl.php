<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:_announcements.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf8d1533_23720218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c59765837e6ee18a2a3570b3007819a14ed8b28e' => 
    array (
      0 => '_announcements.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6964acdf8d1533_23720218 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('announcements'), 'announcement');
$foreach21DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('announcement')->value) {
$foreach21DoElse = false;
?>
  <div class="alert alert-<?php echo $_smarty_tpl->getValue('announcement')['type'];?>
 text-with-list">
    <?php if ($_smarty_tpl->getValue('user')->_logged_in) {?>
      <button type="button" class="btn-close float-end js_announcment-remover" data-id="<?php echo $_smarty_tpl->getValue('announcement')['announcement_id'];?>
"></button>
    <?php }?>
    <?php if ($_smarty_tpl->getValue('announcement')['title']) {?><div class="title"><?php echo $_smarty_tpl->getValue('announcement')['title'];?>
</div><?php }?>
    <?php echo $_smarty_tpl->getValue('announcement')['code'];?>

  </div>
<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
}
}
