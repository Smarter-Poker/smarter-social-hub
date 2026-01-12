<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:_widget.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf922df6_46341854',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9b6367caaaacccf434edd3899edc7b9e825297a' => 
    array (
      0 => '_widget.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6964acdf922df6_46341854 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
if ($_smarty_tpl->getValue('widgets')) {?>
  <!-- Widgets -->
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('widgets'), 'widget');
$foreach27DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('widget')->value) {
$foreach27DoElse = false;
?>
    <?php if ($_smarty_tpl->getValue('widget')['target_audience'] == 'all' || ($_smarty_tpl->getValue('widget')['target_audience'] == 'visitors' && !$_smarty_tpl->getValue('user')->_logged_in) || ($_smarty_tpl->getValue('widget')['target_audience'] == 'members' && $_smarty_tpl->getValue('user')->_logged_in)) {?>
      <div class="card">
        <div class="card-header">
          <strong><?php ob_start();
echo $_smarty_tpl->getValue('widget')['title'];
$_prefixVariable1 = ob_get_clean();
echo $_smarty_tpl->getSmarty()->getModifierCallback('__')($_prefixVariable1);?>
</strong>
        </div>
        <div class="card-body"><?php echo $_smarty_tpl->getValue('widget')['code'];?>
</div>
      </div>
    <?php }?>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  <!-- Widgets -->
<?php }
}
}
