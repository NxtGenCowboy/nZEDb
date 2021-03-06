<?php

require_once("config.php");
require_once(WWW_DIR."/lib/adminpage.php");
require_once(WWW_DIR."/lib/tmux.php");
require_once(WWW_DIR."/lib/sabnzbd.php");

$page = new AdminPage();
$tmux = new Tmux();
$id = 0;

// set the current action
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'view';

switch($action)
{
	case 'submit':

		$error = "";
		$ret = $tmux->update($_POST);
		$page->title = "Tmux Settings Edit";
		$settings = $tmux->get();
		$page->smarty->assign('ftmux', $settings);

		break;
	case 'view':
	default:

		$page->title = "Tmux Settings Edit";
		$settings = $tmux->get();
		$page->smarty->assign('ftmux', $settings);

		break;
}

$page->smarty->assign('yesno_names', array('yes', 'no'));
$page->smarty->assign('truefalse_names', array('TRUE', 'FALSE'));

$page->smarty->assign('backfill_ids', array(0,4,2,1));
$page->smarty->assign('backfill_names', array('Disabled', 'Safe', 'All', 'Interval'));
$page->smarty->assign('backfill_group_ids', array(1,2,3,4,5,6));
$page->smarty->assign('backfill_group', array('Newest', 'Oldest', 'Alphabetical', 'Alphabetical - Reverse', 'Most Posts', 'Fewest Posts'));
$page->smarty->assign('backfill_days', array('Days per Group', 'Safe Backfill day'));
$page->smarty->assign('backfill_days_ids', array(1,2));

$page->content = $page->smarty->fetch('tmux-edit.tpl');
$page->render();
