<?php
class AdminController extends Controller {
    public function __construct() { session_start(); }
    public function index($mode = "", $message = "")
    {
        if (isset($_SESSION['admin'])) {
            header("location: http://hotel.com/Admin/Dashboard");
            exit();
        }
        if (empty($mode)) {
            $this->view('Admin/index', "hotel Login", ['error' => $message]);
            $this->view->render();
        } else {
            if (isset($_POST['submit'])) {
                $adminName = $this->Validate($_POST['admin_name']);
                $adminPassword = $this->Validate($_POST['password']);
                if (empty($adminName) || empty($adminPassword)) {
                    $this->index("", "Empty admin name or password");
                    return;
                }
                $this->model('Admin');
                if (!$this->model->getAdmin($adminName)) {
                    $this->index("", "Incorrect Admin name !");
                    return;
                }
                if (!($this->model->getAdmin($adminName)['password'] == $adminPassword)) {
                    $this->index("", "Incorrect password !");
                    return;
                }
                if ($this->model->getAdmin($adminName)['name'] == $adminName && $this->model->getAdmin($adminName)['password'] == $adminPassword) {
                    $_SESSION['admin'] = $adminName;
                    header("Location: http://hotel.com/Admin/Dashboard/");
                    exit();
                }
            }
            header("Location: http://hotel.com/Admin/");
        }
    }
    public function Login(){}
    public function dashboard() {
        $this->view('Admin/dashboard', "hotel Dashboard"    );
        $this->view->render();
    }
    public function Validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}