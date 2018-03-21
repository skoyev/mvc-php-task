<?php

/**
 * Sergiy Koyev. Base Framework class.
 */
class Framework {


   public static function run() {
       self::init();
       self::autoload();
       self::dispatch();
   }

   private static function init() {
     define("DS", DIRECTORY_SEPARATOR);
     define("ROOT", getcwd() . DS);

     define("APP_PATH", ROOT . 'application' . DS);
     define("FRAMEWORK_PATH", ROOT . "framework" . DS);
     define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);
     define("MODEL_PATH", APP_PATH . "models" . DS);
     define("VIEW_PATH", APP_PATH . "views" . DS);
     define("VIEW_COMMON_PATH", VIEW_PATH . "common" . DS);
     define("VIEW_PARTIAL_PATH", VIEW_PATH . "partial" . DS);

     define("CONFIG_PATH", APP_PATH . "config" . DS);
     define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);
     define('DB_PATH', FRAMEWORK_PATH . "database" . DS);
     define("HELPER_PATH", FRAMEWORK_PATH . "helpers" . DS);

     define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : 'login');
     define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Index');
     define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'index');

     define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
     define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);

     // Load core classes
     require CORE_PATH . "Controller.class.php";
     require CORE_PATH . "Loader.class.php";
     require DB_PATH .   "MySql.class.php";
     require CORE_PATH . "Model.class.php";
     require CORE_PATH . "Query.class.php";

     // Load configuration file
     $GLOBALS['config'] = include CONFIG_PATH . "config.php";

     session_start();
   }

   private static function autoload() {
     spl_autoload_register(array(__CLASS__,'load'));
   }

   private static function load($classname){
       if (substr($classname, -10) == "Controller"){
           // Controller
           require_once CURR_CONTROLLER_PATH . "$classname.class.php";
       } elseif (substr($classname, -5) == "Model"){
           // Model
           require_once  MODEL_PATH . "$classname.class.php";
       }
   }

   private static function dispatch() {
     $controller_name = ucfirst(CONTROLLER) . "Controller";
     $action_name = ACTION . "Action";
     $controller = new $controller_name;
     $controller->$action_name();
   }
}
