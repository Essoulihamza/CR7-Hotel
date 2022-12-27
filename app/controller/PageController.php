<?php
class PageController extends Controller {
    public function __construct()
    {
        session_start();
    }
    public function index() {
        $this->view('Pages/index', 'Home');
        $this->view->render();
    }
    public function Booking() {
        
            $this->view('Pages/Booking', 'Booking', []);
            $this->view->render();
            
    }
    public function Login($mode='') {
        $this->model('user');
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
                else if(!$this->model->getUser($userName)) {
                    $this->view('Pages/Login', 'login', ['message' =>'Incorrect user name .']);
                    $this->view->render();
                }
                else if(!password_verify($password, $this->model->getUser($userName)['password'])) {
                    $this->view('Pages/Login', 'login', ['message' =>'Incorrect password .']);
                    $this->view->render();
                }
                else if($this->model->getUser($userName)['admin']) {
                    $_SESSION['admin'] = true;
                    header('location: http://hotel.com/page/index');
                    return;
                }
                else if(!$_SESSION['admin']){
                    $_SESSION['admin'] = false;
                    header('location: http://hotel.com/page/index');
                }
                else
                header('location: http://hotel.com/page/login');
            }
        }
        
    }
    public function SignUp($mode='') {
        $this->model('user');
        if(empty($mode)) {
            $this->view('Pages/sign-up', 'Sign Up');
            $this->view->render();
        }
        else {
            if(isset($_POST['sign-up'])) {
                $userName = $this->Validate($_POST['user_name']);
                $password = $this->Validate($_POST['password']);
                if(empty($userName)) {
                    $this->view('Pages/sign-up', 'Sign Up', ['message' =>'user name is required']);
                    $this->view->render();
                } else if(empty($password)) {
                    $this->view('Pages/sign-up', 'Sign Up', ['message' =>'password is required']);
                    $this->view->render();
                    return;
                }
                if(strlen($userName) <= 3) {
                    $this->view('Pages/sign-up', 'Sign Up', ['message' =>'user name must be more than 3 characters.']);
                    $this->view->render();
                }
                else if(strlen($password) <= 3) {
                    $this->view('Pages/sign-up', 'Sign Up', ['message' =>'password must be more than 3 characters.']);
                    $this->view->render();
                }
                else {

                    $this->model->insertUser($userName, password_hash($password, PASSWORD_BCRYPT));
                    $_SESSION['admin'] = false;
                    header('location: http://hotel.com/page/index');
                }
            }
        }

    }
    public function logout(){
        session_destroy();
        header('location: http://hotel.com/page/index');
    }
    public function dashboard() {
        if($_SESSION['admin']) {
            $this->view('Pages/dashboard', 'Dashboard');
            $this->view->render();
        }else {
            header('location: http://hotel.com/page/index');
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