<?php 
namespace controller;

use view\Page404View;

class Page404Controller {

    public function page404() {
        $view = new Page404View();
        $view->page404();
    }

}

?>