<?php
require_once "lib/modules.table.db.php";

require_once "inc/conf.inc.php";
require_once "inc/session.inc.php";
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";

print_r($_SESSION);
print_r($_POST);


$module = $_SESSION['module'];
$view   = $_SESSION['view'];
$action = $_SESSION['action'];
$user   = $_SESSION['user'];

$smarty = new Smarty();

$smarty->assign('module',$module);
$smarty->assign('view',$view);
$smarty->assign('user',$user);

$smarty->display('templates/header.tpl');

$dbModules = new ModulesTable();
$smarty->assign('modules',$dbModules->getTitles());

$smarty->display('templates/navigation.tpl');

if(is_file('modules/'.$module.'/'.$module.'.php')) {
    require_once 'modules/'.$module.'/'.$module.'.php';
    $smarty_module = new $module($view,$action);
} else {
    $smarty->assign('error','No such module :: '.$module);
}

$smarty->display('templates/footer.tpl');








?>




