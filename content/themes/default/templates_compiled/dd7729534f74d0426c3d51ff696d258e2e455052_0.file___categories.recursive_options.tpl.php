<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:__categories.recursive_options.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf90b3a0_77246318',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd7729534f74d0426c3d51ff696d258e2e455052' => 
    array (
      0 => '__categories.recursive_options.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__categories.recursive_options.tpl' => 2,
  ),
))) {
function content_6964acdf90b3a0_77246318 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
?><option <?php if ($_smarty_tpl->getValue('data_category') == $_smarty_tpl->getValue('category')['category_id']) {?>selected style="font-weight: 600;" class="bg-info" <?php }?> value="<?php echo $_smarty_tpl->getValue('category')['category_id'];?>
">
  <?php echo str_repeat((string) "- - ", (int) $_smarty_tpl->getValue('category')['iteration']);
echo $_smarty_tpl->getSmarty()->getModifierCallback('__')($_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('category')['category_name'],30));?>

</option>
<?php if ($_smarty_tpl->getValue('category')['sub_categories']) {?>
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('category')['sub_categories'], '_category');
$foreach26DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('_category')->value) {
$foreach26DoElse = false;
?>
    <?php $_smarty_tpl->renderSubTemplate('file:__categories.recursive_options.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('category'=>$_smarty_tpl->getValue('_category')), (int) 0, $_smarty_current_dir);
?>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
}
}
}
