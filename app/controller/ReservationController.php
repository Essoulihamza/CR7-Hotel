<?php
class ReservationController extends Controller 
{
    public function reserveChamber($user_id) 
    {
        $room_id = $_POST['id'];
        $start = $_POST['start-date'];
        $end = $_POST['end-date'];
        $guest = [];
        for ($i = 0; $i < count($_POST['name']); $i++) {
            array_push($guest, ['guest' . $i+1  => ['guest_name' => $_POST['name'][$i], 'birthday' => $_POST['birthday'][$i]]]);
        }
        $this->model('reservation')->addReservation($user_id, $room_id, $start, $end, json_encode($guest));
        header('location: http://hotel.com/page/MyRooms');
    }
    public function delete($id) {
        $this->model('reservation')->deleteReservation($id);
        header('location: http://hotel.com/page/MyRooms');
    }
}
