<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:_ads_campaigns.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf9519d1_12585955',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '969cf8e9ed737e9794636f493295cf701a55b356' => 
    array (
      0 => '_ads_campaigns.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 1,
    'file:__feeds_post.tpl' => 1,
  ),
))) {
function content_6964acdf9519d1_12585955 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
if ($_smarty_tpl->getValue('ads_campaigns')) {?>
  <!-- ads campaigns -->
  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('ads_campaigns'), 'campaign');
$foreach30DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('campaign')->value) {
$foreach30DoElse = false;
?>
    <div class="card <?php if ($_smarty_tpl->getValue('campaign')['ads_type'] == "post") {?>bg-transparent<?php }?>">
      <div class="card-header bg-transparent <?php if ($_smarty_tpl->getValue('campaign')['ads_type'] == "post") {?>plr0 pb0<?php }?>">
        <i class="fa fa-bullhorn fa-fw mr5 yellow"></i><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Sponsored");?>

        <?php if ($_smarty_tpl->getValue('user')->_logged_in && $_smarty_tpl->getValue('user')->_data['user_id'] != $_smarty_tpl->getValue('campaign')['campaign_user_id']) {?>
          <div class="float-end">
            <span class="pointer" data-toggle="modal" data-url="data/report.php?do=create&handle=ads_campaign&id=<?php echo $_smarty_tpl->getValue('campaign')['campaign_id'];?>
">
              <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"report",'class'=>"main-icon mr10",'width'=>"20px",'height'=>"20px"), (int) 0, $_smarty_current_dir);
?>
            </span>
          </div>
        <?php }?>
      </div>
      <div class="card-body <?php if ($_smarty_tpl->getValue('campaign')['campaign_bidding'] == 'click') {?>js_ads-click-campaign<?php }?> <?php if ($_smarty_tpl->getValue('campaign')['ads_type'] == "post") {?>plr0 pb0<?php }?>" data-id="<?php echo $_smarty_tpl->getValue('campaign')['campaign_id'];?>
">
        <?php if ($_smarty_tpl->getValue('campaign')['ads_type'] == "post") {?>
          <?php $_smarty_tpl->renderSubTemplate('file:__feeds_post.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('post'=>$_smarty_tpl->getValue('campaign')['ads_post'],'standalone'=>true), (int) 0, $_smarty_current_dir);
?>
        <?php } else { ?>
          <a href="<?php echo $_smarty_tpl->getValue('campaign')['ads_url'];?>
" target="_blank">
            <?php if ($_smarty_tpl->getValue('campaign')['ads_image']) {?>
              <img class="img-fluid" src="<?php echo $_smarty_tpl->getValue('system')['system_uploads'];?>
/<?php echo $_smarty_tpl->getValue('campaign')['ads_image'];?>
">
            <?php } else { ?>
              <video class="img-fluid mx-auto d-block" src="<?php echo $_smarty_tpl->getValue('system')['system_uploads'];?>
/<?php echo $_smarty_tpl->getValue('campaign')['ads_video'];?>
" autoplay muted loop></video>
            <?php }?>
          </a>
          <?php if ($_smarty_tpl->getValue('campaign')['ads_title'] || $_smarty_tpl->getValue('campaign')['ads_description']) {?>
            <div class="ptb5 plr10">
              <p class="ads-title">
                <a href="<?php echo $_smarty_tpl->getValue('campaign')['ads_url'];?>
" target="_blank"><?php echo $_smarty_tpl->getValue('campaign')['ads_title'];?>
</a>
              </p>
              <p class="ads-descrition">
                <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('campaign')['ads_description'],200);?>

              </p>
            </div>
          <?php }?>
        <?php }?>
      </div>
    </div>
  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  <!-- ads campaigns -->
<?php }
}
}
