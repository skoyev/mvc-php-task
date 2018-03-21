<?php

/**
 * @author Sergiy Koyev
 * Index Controller calass implementation.
 */
class IndexController extends Controller{

    public function indexAction(){

        include  CURR_VIEW_PATH . "index.html";
    }

    public function loginTaskAction(){

      if (isset($_POST['userName']) &&
            isset($_POST['password'])) {

            if($_POST['userName'] == 'admin'
                  && $_POST['password'] = '1111') {
                $_SESSION["isloggedIn"] = TRUE;
            }
      }

      header ("location:index.php?p=home&a=home&c=home");
    }

    public function logoutTaskAction(){

      session_destroy();
      header ("location:index.php");
    }
}
