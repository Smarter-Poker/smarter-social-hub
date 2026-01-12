<?php
/* Smarty version 5.7.0, created on 2026-01-12 08:12:15
  from 'file:_footer.bottom_bar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.7.0',
  'unifunc' => 'content_6964acdf9935e2_47728015',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fdb0ba3c502fcc7a5d64d479c99750cc173e412e' => 
    array (
      0 => '_footer.bottom_bar.tpl',
      1 => 1768203508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:__svg_icons.tpl' => 15,
    'file:_user_menu.tpl' => 1,
  ),
))) {
function content_6964acdf9935e2_47728015 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/Users/smarter.poker/Documents/SmarterSocial/web/content/themes/default/templates';
?><div class="footer-bottom-bar<?php if ($_smarty_tpl->getValue('page') == 'reels') {?>x-hidden<?php }?>">
  <div class="container">
    <div class="footer-bottom-bar-links">
      <!-- home -->
      <div class="link <?php if ($_smarty_tpl->getValue('page') == 'index' && $_smarty_tpl->getValue('view') == '') {?>active<?php }?>">
        <a href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
">
          <?php ob_start();
if ($_smarty_tpl->getValue('page') == "index" && $_smarty_tpl->getValue('view') == '') {
echo "active";
}
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"header-home",'class'=>"header-icon ".$_prefixVariable2,'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
          <div class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Home");?>
</div>
        </a>
      </div>
      <!-- home -->

      <!-- watch -->
      <?php if ($_smarty_tpl->getValue('system')['reels_enabled']) {?>
        <div class="link <?php if ($_smarty_tpl->getValue('page') == 'reels') {?>active<?php }?>">
          <a href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/reels">
          <?php ob_start();
if ($_smarty_tpl->getValue('page') == "reels") {
echo "active";
}
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"reels",'class'=>"header-icon ".$_prefixVariable3,'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
          <div class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Reels");?>
</div>
        </a>
      </div>
      <?php } elseif ($_smarty_tpl->getValue('system')['watch_enabled']) {?>
      <div class="link <?php if ($_smarty_tpl->getValue('page') == 'index' && $_smarty_tpl->getValue('view') == 'watch') {?>active<?php }?>">
        <a href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/watch">
          <?php ob_start();
if ($_smarty_tpl->getValue('page') == "index" && $_smarty_tpl->getValue('view') == "watch") {
echo "active";
}
$_prefixVariable4=ob_get_clean();
$_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"watch",'class'=>"header-icon ".$_prefixVariable4,'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
          <div class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Watch");?>
</div>
        </a>
      </div>
      <?php }?>
      <!-- watch -->

      <!-- add -->
      <?php if ($_smarty_tpl->getValue('user')->_data['can_publish_posts'] || $_smarty_tpl->getValue('user')->_data['can_go_live'] || $_smarty_tpl->getValue('user')->_data['can_add_stories'] || $_smarty_tpl->getValue('user')->_data['can_write_blogs'] || $_smarty_tpl->getValue('system')['market_enabled'] || $_smarty_tpl->getValue('user')->_data['can_raise_funding'] || $_smarty_tpl->getValue('user')->_data['can_create_ads'] || $_smarty_tpl->getValue('system')['pages_enabled'] || $_smarty_tpl->getValue('system')['groups_enabled'] || $_smarty_tpl->getValue('system')['events_enabled']) {?>
        <div class="link">
          <a class="dropdown" href="#" data-bs-toggle="dropdown" data-display="static">
            <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"header-plus",'class'=>"header-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
            <div class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Add");?>
</div>
          </a>
          <div class="dropdown-menu dropdown-widget">
            <div class="js_scroller" data-slimScroll-height="360">
              <div class="footer-quick-adds">
                <?php if ($_smarty_tpl->getValue('user')->_data['can_publish_posts']) {?>
                  <div class="add-quick-item full" data-toggle="modal" data-url="posts/publisher.php">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"newsfeed",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Post");?>
</div>
                  </div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('user')->_data['can_go_live']) {?>
                  <a class="add-quick-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/live">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"live",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Live");?>
</div>
                  </a>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('user')->_data['can_add_stories']) {?>
                  <div class="add-quick-item" data-toggle="modal" data-url="posts/story.php?do=create">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"24_hours",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Story");?>
</div>
                  </div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('user')->_data['can_write_blogs']) {?>
                  <a class="add-quick-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/blogs/new">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"blogs",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Blog");?>
 <?php if ($_smarty_tpl->getValue('system')['paid_blogs_enabled']) {?><span class="badge rounded-pill text-bg-danger"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Paid");?>
</span><?php }?></div>
                  </a>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('system')['market_enabled']) {?>
                  <div class="add-quick-item" data-toggle="modal" data-url="posts/product.php?do=create">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"products",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Product");?>
 <?php if ($_smarty_tpl->getValue('system')['paid_products_enabled']) {?><span class="badge rounded-pill text-bg-danger"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Paid");?>
</span><?php }?></div>
                  </div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('user')->_data['can_raise_funding']) {?>
                  <div class="add-quick-item" data-toggle="modal" data-url="posts/funding.php?do=create">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"funding",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Funding");?>
 <?php if ($_smarty_tpl->getValue('system')['paid_funding_enabled']) {?><span class="badge rounded-pill text-bg-danger"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Paid");?>
</span><?php }?></div>
                  </div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('user')->_data['can_create_ads']) {?>
                  <a class="add-quick-item" href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/ads/new">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"ads",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Ads");?>
</div>
                  </a>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('system')['pages_enabled']) {?>
                  <div class="add-quick-item" data-toggle="modal" data-url="modules/add.php?type=page">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"pages",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Page");?>
</div>
                  </div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('system')['groups_enabled']) {?>
                  <div class="add-quick-item" data-toggle="modal" data-url="modules/add.php?type=group">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"groups",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Group");?>
</div>
                  </div>
                <?php }?>
                <?php if ($_smarty_tpl->getValue('system')['events_enabled']) {?>
                  <div class="add-quick-item" data-toggle="modal" data-url="modules/add.php?type=event">
                    <?php $_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"events",'class'=>"main-icon",'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
                    <div class="mt5"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Event");?>
</div>
                  </div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      <?php }?>
      <!-- add -->

      <!-- search -->
      <div class="link <?php if ($_smarty_tpl->getValue('page') == 'search') {?>active<?php }?>">
        <a href="<?php echo $_smarty_tpl->getValue('system')['system_url'];?>
/search">
          <?php ob_start();
if ($_smarty_tpl->getValue('page') == "search") {
echo "active";
}
$_prefixVariable5=ob_get_clean();
$_smarty_tpl->renderSubTemplate('file:__svg_icons.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('icon'=>"header-search",'class'=>"header-icon ".$_prefixVariable5,'width'=>"24px",'height'=>"24px"), (int) 0, $_smarty_current_dir);
?>
          <div class="title"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('__')("Search");?>
</div>
        </a>
      </div>
      <!-- search -->

      <!-- menu -->
      <div class="link">
        <?php $_smarty_tpl->renderSubTemplate('file:_user_menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('_as_widget'=>true), (int) 0, $_smarty_current_dir);
?>
      </div>
      <!-- menu -->

    </div>
  </div>
</div><?php }
}
