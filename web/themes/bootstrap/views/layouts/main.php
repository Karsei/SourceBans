<?php Yii::app()->bootstrap->registerCoreCss() ?>
<?php Yii::app()->bootstrap->registerYiiCss() ?>
<?php Yii::app()->bootstrap->registerCoreScripts() ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/style.css') ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/sourcebans.js') ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/template.js') ?>
<?php Yii::app()->clientScript->registerLinkTag('shortcut icon', 'image/x-icon', Yii::app()->baseUrl . '/images/favicon.ico') ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language ?>">
  <head>
    <title><?php if(!empty($this->title)) echo CHtml::encode($this->title . Yii::app()->params['titleSeparator']) ?><?php echo CHtml::encode(Yii::app()->name) ?></title>
    <meta charset="UTF-8" />
    <meta name="author" content="GameConnect" />
    <meta name="copyright" content="SourceBans © 2007-2013 GameConnect.net. All rights reserved." />
    <meta name="description" content="Advanced admin and ban management for the Source engine" />
  </head>
  <body id="<?php echo (!empty($this->pageId) ? $this->pageId : $this->id . '_' . $this->action->id); ?>">
    <header>
      <div class="container">
        <div class="navbar">
          <div class="navbar-inner">
            <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/logo.png', CHtml::encode(Yii::app()->name)), Yii::app()->homeUrl, array('class' => 'brand')) ?>

<?php $this->widget('zii.widgets.CMenu', array(
	'id' => 'tabs',
	'items' => array_merge(array(
		array(
			'active' => $this->route == 'default/dashboard' || ($this->route == 'default/index' && SourceBans::app()->settings->default_page == 'dashboard'),
			'label' => Yii::t('sourcebans', 'controllers.default.dashboard.title'),
			'url' => array('default/dashboard'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'This page shows an overview of your bans and servers.')),
		),
		array(
			'active' => $this->route == 'default/bans' || ($this->route == 'default/index' && SourceBans::app()->settings->default_page == 'bans'),
			'label' => Yii::t('sourcebans', 'controllers.default.bans.title'),
			'url' => array('default/bans'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'All of the bans in the database can be viewed from here.')),
		),
		array(
			'active' => $this->route == 'default/servers' || ($this->route == 'default/index' && SourceBans::app()->settings->default_page == 'servers'),
			'label' => Yii::t('sourcebans', 'controllers.default.servers.title'),
			'url' => array('default/servers'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'All of your servers and their status can be viewed here.')),
		),
		array(
			'active' => $this->route == 'default/report' || ($this->route == 'default/index' && SourceBans::app()->settings->default_page == 'report'),
			'label' => Yii::t('sourcebans', 'controllers.default.report.title'),
			'url' => array('default/report'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'You can submit a demo or screenshot of a suspected cheater here. It will then be up for review by one of the admins.')),
			'visible' => SourceBans::app()->settings->enable_reports,
		),
		array(
			'active' => $this->route == 'default/appeal' || ($this->route == 'default/index' && SourceBans::app()->settings->default_page == 'appeal'),
			'label' => Yii::t('sourcebans', 'controllers.default.appeal.title'),
			'url' => array('default/appeal'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'Here you can protest your ban. And prove your case as to why you should be unbanned.')),
			'visible' => SourceBans::app()->settings->enable_appeals,
		),
		array(
			'active' => $this->id == 'admin',
			'label' => Yii::t('sourcebans', 'controllers.admin.index.title'),
			'url' => array('admin/index'),
			'linkOptions' => array('title' => Yii::t('sourcebans', 'This is the control panel for SourceBans where you can setup new admins, add new servers, etc.')),
			'visible' => !Yii::app()->user->isGuest,
		),
	), $this->tabs),
	'htmlOptions' => array(
		'class' => 'nav pull-right',
	),
)) ?>

          </div>
        </div>
      </div>
      <hr />
<?php $this->widget('bootstrap.widgets.TbAlert', array(
	'block' => false,
	'htmlOptions' => array(
		'class' => 'page-alert',
	),
)) ?>

    </header>
    
    <div class="container">
      <header class="clearfix">
        <div class="pull-left">
          <h1><?php echo CHtml::encode($this->pageTitle) ?></h1>
<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
	'links' => $this->breadcrumbs,
)) ?>

        </div>
        <div class="pull-right">
          <form action="<?php echo $this->createUrl('default/bans') ?>" class="input-append pull-right" id="search">
            <input class="span2" placeholder="<?php echo Yii::t('sourcebans', 'Search bans') ?>" name="q" type="search" />
            <button class="btn btn-inverse" type="submit"><i class="icon-search icon-white"></i></button>
          </form>
          <nav>
<?php $this->widget('zii.widgets.CMenu', array(
	'id' => 'user',
	'items' => array(
		array(
			'label' => Yii::app()->user->name,
			'url' => array('default/account'),
			'visible' => !Yii::app()->user->isGuest,
		),
		array(
			'label' => Yii::t('sourcebans', 'controllers.default.logout.title'),
			'url' => array('default/logout'),
			'visible' => !Yii::app()->user->isGuest,
		),
		array(
			'label' => Yii::t('sourcebans', 'controllers.default.login.title'),
			'url' => array('default/login'),
			'visible' => Yii::app()->user->isGuest,
		),
	),
	'htmlOptions' => array(
		'class' => 'nav pull-right',
	),
	'itemTemplate' => '{menu}<span class="divider">|</span>',
	'lastItemCssClass' => 'last',
)) ?>

          </nav>
        </div>
      </header>
      
<?php echo $content ?>
      
    </div>
    
    <footer>
      <hr />
      <div class="container">
        <p>
          <a href="http://sourcebans.net" target="_blank"><img alt="SourceBans" src="<?php echo Yii::app()->theme->baseUrl ?>/images/logo_footer.png" /></a>
          <br /><strong><?php echo Yii::t('sourcebans', 'Version') ?> <?php echo SourceBans::getVersion() ?></strong>
          <br />"<?php echo SourceBans::app()->quote->text ?>" - <em><?php echo SourceBans::app()->quote->name ?></em>
        </p>
<?php if(YII_DEBUG): ?>
        <p><em><?php echo Yii::app()->db->stats[0] ?> database queries performed in <?php echo number_format(Yii::getLogger()->executionTime, 2) ?> seconds.</em></p>
<?php endif ?>
      </div>
    </footer>
  </body>
</html>