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
    public function login(){
        $this->view('Pages/Login', 'login');
        $this->view->render();
    }
    public function signUp(){
        $this->view('Pages/sign-up', 'Sign Up');
        $this->view->render();
    }
    public function Booking() {
        if ($_SESSION['id']) {
            $this->view('Pages/Booking', 'Booking', ['id' => $_SESSION['id']]);
            $this->view->render();
        }
    }
    public function myRooms() {
        if ($_SESSION['id']) {
            $this->view('Pages/myRooms', 'MyRooms', [ 'reservations' => $this->model('reservation')->getUserReservations($_SESSION['id']) ]);
            $this->view->render();
        }
    }


    public function dashboard() {
        if($_SESSION['admin']) {
            $this->model('Chamber');
            $this->view('Pages/dashboard', 'Dashboard', ['chambers' => $this->model->getChambers()]);
            $this->view->render();
        }else {
            header('location: http://hotel.com/page/index');
        }
    }
    public function add() {
        if($_SESSION['admin'])
            $this->view('Pages/add', 'add chamber')->render();
        else
            header('Location: http://hotel.com/page/index');
    }
    public function edit($id) {
        if($_SESSION['admin']) {
            $this->model('chamber')->getChamber($id);
            $this->view('Pages/edit', 'edit chamber', ['chamber' => $this->model])->render();
        }
            
        else
            header('Location: http://hotel.com/page/index');
    }
     public function Validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}