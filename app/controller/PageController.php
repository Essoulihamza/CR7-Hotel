<?php
class PageController extends Controller {
    public function index() {
        $this->view('Pages/index', 'Home');
        $this->view->render();
    }
    public function Booking() {
        
            $this->view('Pages/Booking', 'Booking', []);
            $this->view->render();
            
    }
    public function Login($mode='') {
        if(empty($mode)) {
            $this->view('Pages/Login', 'login');
            $this->view->render();
        }
        else {
            if(isset($_POST['login'])) {
                $userName = $this->Validate($_POST['user_name']);
                $password = $this->Validate($_POST['password']);
                if(empty($userName)) {
                    $this->view('Pages/Login', 'login', ['message' =>'Empty user name']);
                    $this->view->render();
                } else if(empty($password)) {
                    $this->view('Pages/Login', 'login', ['message' =>'Empty password']);
                    $this->view->render();
                }
            }
        }
        
    }
     public function Validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}