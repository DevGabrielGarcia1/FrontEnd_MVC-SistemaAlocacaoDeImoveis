<?php 
namespace controller;

use view\Page404View;
use view\Page500View;

class PageErrorsController {

    public function page404() {
        $view = new Page404View();
        $view->page404();
    }

    public function page500(){
        $view = new page500View();
        $view->page500();
    }

}

?>