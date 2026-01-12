<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:10:19
  from 'file:_ads.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964ac6bd2e579_83425122',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe466802986aadebc94ba7173e3420394d5d7061' => 
    array (
      0 => '_ads.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6964ac6bd2e579_83425122 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
if ($_smarty_tpl->getValue('_master')) {?>

  <?php if ($_smarty_tpl->getValue('_ads') && !$_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('page'),array("static","settings","admin"))) {?>
    <div class="<?php if ($_smarty_tpl->getValue('system')['fluid_design']) {?>container-fluid<?php } else { ?>container<?php }?> mtb20">
      <!-- ads -->
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('_ads'), 'ads_unit');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('ads_unit')->value) {
$foreach0DoElse = false;
?>
        <div class="card">
          <div class="card-header bg-transparent">
            <i class="fa fa-bullhorn fa-fw mr5 yellow"></i><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Sponsored");?>

          </div>
          <div class="card-body"><?php echo $_smarty_tpl->getValue('ads_unit')['code'];?>
</div>
        </div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <!-- ads -->
    </div>
  <?php }?>

<?php } else { ?>

  <?php if ($_smarty_tpl->getValue('ads')) {?>
    <!-- ads -->
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('ads'), 'ads_unit');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('ads_unit')->value) {
$foreach1DoElse = false;
?>
      <div class="card">
        <div class="card-header bg-transparent">
          <i class="fa fa-bullhorn fa-fw mr5 yellow"></i><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Sponsored");?>

        </div>
        <div class="card-body"><?php echo $_smarty_tpl->getValue('ads_unit')['code'];?>
</div>
      </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    <!-- ads -->
  <?php }?>

<?php }
}
}
