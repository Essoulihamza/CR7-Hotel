<?php
class PageController extends Controller {
    public function index() {
        $this->view('Pages/index', 'Home');
        $this->view->render();
    }
    public function login(){}
    public function SignUp(){}
    public function Booking(){
        $this->view('Pages/booking', 'Home');
        $this->view->render();
    }
    public function About(){}
    public function Contact(){}

}