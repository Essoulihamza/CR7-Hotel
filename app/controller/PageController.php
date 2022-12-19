<?php
class PageController extends Controller {
    public function index() {
        $this->view('Pages/index', 'Home');
        $this->view->render();
    }
}