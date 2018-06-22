<?php
// mettre vos constantes ici...
define("WEBAPP_DIR","C:/users/levan/_boulot/eclipse/Tutoriaux");
define("MODEL_DIR",WEBAPP_DIR."/PHP-INF/model");
define("ROOT_URL","http://localhost/Tutoriaux");
define("BASE_URL","/Tutoriaux/");
define("ZEND_FRAMEWORK_DIR","C:/phplib/ZendFramework/library");
define("LOG_FILE","C:/tutoriaux.log");
 
define("DB_SERVER","localhost");
define("DB_PORT","3306");
define("DB_NAME","tutoriaux");
define("DB_USER","root");
define("DB_PASSWORD","");
define("DB_TYPE","PDO_MYSQL");
 
 
set_include_path(
  ".".PATH_SEPARATOR.
  MODEL_DIR.PATH_SEPARATOR.
  ZEND_FRAMEWORK_DIR.PATH_SEPARATOR.
  get_include_path()
);
 
require_once 'Zend/Loader.php';
 
// Registry init
Zend_Loader::loadClass("Zend_Registry");
 
// Logger init
Zend_Loader::loadClass('Zend_Log');
Zend_Loader::loadClass('Zend_Log_Writer_Stream');
$logger = new Zend_Log();
$logger->addWriter(new Zend_Log_Writer_Stream(LOG_FILE));
Zend_Registry::set("logger",$logger);
Zend_Registry::get("logger")
    ->debug("** URI=".$_SERVER["REQUEST_URI"]);
 
// Controller init
Zend_Loader::loadClass('Zend_Controller_Front');
Zend_Loader::loadClass('Zend_Controller_Router_Rewrite');
$controller = Zend_Controller_Front::getInstance();
 
$router = new Zend_Controller_Router_Rewrite();
 
$cmtRoute = new Zend_Controller_Router_Route(
    "comment/:action/:comment",
    array(  "comment"=>null,
            "controller"=>"comment",
            "action"=>"display"
    )
);
$router->addRoute("comment",$cmtRoute);
$controller->setBaseUrl(BASE_URL);
 
$controller->setRouter($router);
$controller->setControllerDirectory('PHP-INF/ctrl');
$controller->throwExceptions(true);
 
// init viewRenderer
Zend_Loader::loadClass("Zend_View");
$view = new Zend_View();
$viewRenderer = Zend_Controller_Action_HelperBroker::
    getStaticHelper('viewRenderer');
$viewRenderer->setView($view)
             ->setViewSuffix('phtml');
 
// call dispatcher
$controller->dispatch();
?>