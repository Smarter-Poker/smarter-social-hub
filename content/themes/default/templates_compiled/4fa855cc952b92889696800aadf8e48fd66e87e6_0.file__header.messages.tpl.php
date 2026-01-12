<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:_header.messages.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf86bb57_47271034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4fa855cc952b92889696800aadf8e48fd66e87e6' => 
    array (
      0 => '_header.messages.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 2,
    'file:__feeds_conversation.tpl' => 1,
  ),
))) {
function content_6964acdf86bb57_47271034 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
if ($_smarty_tpl->getValue('system')['redirect_to_mobile_apps']) {?>
  <li class="d-block d-md-none">
    <a href="#" onclick="open_messenger_app()">
      <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"header-messages",'class'=>"header-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
      <span class="counter red shadow-sm rounded-pill <?php if ($_smarty_tpl->getValue('user')->_data['user_live_messages_counter'] == 0) {?>x-hidden<?php }?>">
        <?php echo $_smarty_tpl->getValue('user')->_data['user_live_messages_counter'];?>

      </span>
    </a>
  </li>
<?php }?>
<li class="dropdown js_live-messages <?php if ($_smarty_tpl->getValue('system')['redirect_to_mobile_apps']) {?>d-none d-md-block<?php }?>">
  <a href="#" data-bs-toggle="dropdown" data-display="static">
    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"header-messages",'class'=>"header-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
    <span class="counter red shadow-sm rounded-pill <?php if ($_smarty_tpl->getValue('user')->_data['user_live_messages_counter'] == 0) {?>x-hidden<?php }?>">
      <?php echo $_smarty_tpl->getValue('user')->_data['user_live_messages_counter'];?>

    </span>
  </a>
  <div class="dropdown-menu dropdown-menu-end dropdown-widget">
    <div class="dropdown-widget-header">
      <span class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Messages");?>
</span>
      <a class="float-end text-link js_chat-new" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/messages/new"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Send a New Message");?>
</a>
    </div>
    <div class="dropdown-widget-body">
      <div class="js_scroller">
        <?php if ($_smarty_tpl->getValue('user')->_data['conversations']) {?>
          <ul>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('user')->_data['conversations'], 'conversation');
$foreach18DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('conversation')->value) {
$foreach18DoElse = false;
?>
              <?php $_smarty_tpl->renderSubTemplate('file:__feeds_conversation.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
          </ul>
        <?php } else { ?>
          <p class="text-center text-muted mt10">
            <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("No messages");?>

          </p>
        <?php }?>
      </div>
    </div>
    <a class="dropdown-widget-footer" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/messages"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("See All");?>
</a>
  </div>
</li><?php }
}
