<?php
class ReservationController extends Controller 
{
    public function __construct() {
        session_start();
    }
    public function reserveChamber($user_id) 
    {
        $room_id = $_POST['id'];
        $start = $_POST['start-date'];
        $end = $_POST['end-date'];
        $this->model('reservation')->addReservation($user_id, $room_id, $start, $end);
        header('location: http://hotel.com/page/MyRooms');
    }
    public function delete($id) {
        $this->model('reservation')->deleteReservation($id);
        header('location: http://hotel.com/page/MyRooms');
    }
}
