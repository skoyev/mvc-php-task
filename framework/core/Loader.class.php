<?php

/**
 * @author Sergiy Koyev
 * Loader class for loading library and helper classes.
 */
class Loader {

    // Load library classes

    public function library($lib){

        include LIB_PATH . "$lib.class.php";

    }

    public function helper($helper){

        include HELPER_PATH . "{$helper}_helper.php";

    }
}
