<?php
class ChamberController extends Controller {
    public function addRoom(){
        if (isset($_POST['add-chamber'])) {
            
            if (empty($_POST['room-type']) || empty($_POST['room-price'])  || empty($_FILE['room_img']['name'])) {
                $this->view('home', 'dashboard', ['addign error' => 'all the filds are required'])->render();
            } else if ($_POST['room-type'] === "Suit" && (empty($_POST['suit-type']) || empty($_POST['room-capacity']))) {
                $this->view('home', 'dashboard', ['addign error' => 'all the filds are required'])->render();
                return;
            }
            $this->model('Chamber');
            if($_POST['room-type'] != "Suit") {
                $chamberType = $_POST['room-type'];
                $chamberCapacity = ($_POST['room-type'] === 'Single') ? 1 : 2; 
                $chamberPrice = $_POST['room-price'];
                $chamberImage = uniqid('', true).'.'.$_FILES['room_img']['name'];
                move_uploaded_file($_FILES['room_img']['tmp_name'], "./assets/images/chambers/".$chamberImage);
                $this->model->insertChamber($chamberType, $chamberCapacity, $chamberPrice, $chamberImage);
                return header('Location: http://hotel.com/page/dashboard');                
            } else {
                $chamberType = $_POST['room-type'] . "/ " . $_POST['suit-type'];
                $chamberCapacity = $_POST['room-capacity'];
                $chamberPrice = $_POST['room-price'];
                $chamberImage = uniqid('', true).'.'.$_FILES['room_img']['name'];
                move_uploaded_file($_FILES['room_img']['tmp_name'], "./assets/images/chambers/".$chamberImage);
                $this->model->insertChamber($chamberType, $chamberCapacity, $chamberPrice, $chamberImage);
                return header('Location: http://hotel.com/page/dashboard'); 
            }
        }
    }
    public function editRoom($id){
        if (isset($_POST['edit-chamber'])) {
            
            if (empty($_POST['room-type']) || empty($_POST['room-price'])) {
                $this->view('home', 'dashboard', ['editing error' => 'all the filds are required'])->render();
            } else if ($_POST['room-type'] === "Suit" && (empty($_POST['suit-type']) || empty($_POST['room-capacity']))) {
                $this->view('home', 'dashboard', ['editing error' => 'all the filds are required'])->render();
                return;
            }
            $this->model('Chamber');
            
            if($_POST['room-type'] != "Suit") {
                $chamberType = $_POST['room-type'];
                $chamberCapacity = ($_POST['room-type'] === 'Single') ? 1 : 2; 
                $chamberPrice = $_POST['room-price'];
                if(empty($_FILE['room_img']['name'])) {
                    $this->model->updateChamber_no_image($id ,$chamberType, $chamberCapacity, $chamberPrice);
                }else {
                    $chamberImage = uniqid('', true).'.'.$_FILES['room_img']['name'];
                    move_uploaded_file($_FILES['room_img']['tmp_name'], "./assets/images/chambers/".$chamberImage);
                    $this->model->updateChamber($id ,$chamberType, $chamberCapacity, $chamberPrice, $chamberImage);
                }             
            } else {
                $chamberType = $_POST['room-type'] . "/ " . $_POST['suit-type'];
                $chamberCapacity = $_POST['room-capacity'];
                $chamberPrice = $_POST['room-price'];
                if(empty($_FILE['room_img']['name'])) {
                    $this->model->updateChamber_no_image($id ,$chamberType, $chamberCapacity, $chamberPrice);
                }else {
                    $chamberImage = uniqid('', true).'.'.$_FILES['room_img']['name'];
                    move_uploaded_file($_FILES['room_img']['tmp_name'], "./assets/images/chambers/".$chamberImage);
                    $this->model->updateChamber($id ,$chamberType, $chamberCapacity, $chamberPrice, $chamberImage);
                }
            }
            return header('Location: http://hotel.com/page/dashboard');
        }
    }
    public function Delete($id){
        $this->model('chamber');
        $this->model->deleteChamber($id);
        return header('Location: http://hotel.com/page/dashboard'); 
    }
    public function Search($user_id){
        if(isset($_POST['search'])) {
            if($_POST['room-type'] == "Suit")
                $chamberType = $_POST['room-type'] . "/ " . $_POST['suit-type'];
            else
                $chamberType = $_POST['room-type'];
            $this->view('Pages/Booking', 'Booking', ['chambers' => $this->model('chamber')->searchChamber($chamberType, $_POST['starting-date'], $_POST['ending-date']), 'startingDate' => $_POST['starting-date'], 'endingDate' => $_POST['ending-date']]);
            $this->view->render();
        }
    }
    
}