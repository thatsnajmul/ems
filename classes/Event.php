<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
    
?>
<?php
    class Event{

        private $db;
        private $fm;
        
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function eventInsert($data, $file){ 
            
            $eventName = mysqli_real_escape_string($this->db->link, $data['eventName']);
            $body = mysqli_real_escape_string($this->db->link, $data['body']);
            $location = mysqli_real_escape_string($this->db->link, $data['location']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $date = mysqli_real_escape_string($this->db->link, $data['date']);
            $time = mysqli_real_escape_string($this->db->link, $data['time']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image'] ['name'];
            $file_size = $file['image'] ['size'];
            $file_temp = $file['image'] ['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if ($eventName == "" || $body == "" || $file_name == "" || $address == "" || $location == "" || $date == "" || $time == "" || $type == "") {
                $msg = "<span class='error'>Fields Must Not be Empty.</span>";
                return $msg;
            } elseif ($file_size>1048567) {
                echo "<span class='error'>Image Size should be less the 1MB!</span>";
            } elseif (in_array($file_ext, $permited) === false) {
                echo "<span class='error'>You an upload only:-".implode(', ', $permited)."</span>";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_event(eventName, body, image, address, location, date, time, type) VALUES ('$eventName','$body','$uploaded_image','$address','$location','$date','$time', '$type')";
                $inserted_row = $this->db->insert($query);
                $query2 = "INSERT INTO tbl_event_backup(eventName, body, image, address, location, date, time, type) VALUES ('$eventName','$body','$uploaded_image','$address','$location','$date','$time', '$type')";
                $inserted_row = $this->db->insert($query2);
                
                if ($inserted_row) {
                    $msg = "<span class='success'>Event Inserted Successfully.</span>";
                    return $msg;
                } else{
                    $msg = "<span class='error'>Event Not Inserted.</span>";
                    return $msg;
                }
            }

        }

        public function getAllEvent(){
            $query  = "SELECT * FROM tbl_event ORDER BY eventId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getEventById($id){
            $query  = "SELECT * FROM tbl_event WHERE eventId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function EventUpdate($data, $file, $id){
            $eventName = mysqli_real_escape_string($this->db->link, $data['eventName']);
            $body = mysqli_real_escape_string($this->db->link, $data['body']);
            $location = mysqli_real_escape_string($this->db->link, $data['location']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $date = mysqli_real_escape_string($this->db->link, $data['date']);
            $time = mysqli_real_escape_string($this->db->link, $data['time']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image'] ['name'];
            $file_size = $file['image'] ['size'];
            $file_temp = $file['image'] ['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if ($eventName == "") {
                $msg = "<span class='error'>Fields Must Not be Empty.</span>";
                return $msg;
            } else {
                if (!empty($file_name)) {            
                        if ($file_size>1048567) {
                            echo "<span class='error'>Image Size should be less the 1MB!</span>";
                        } elseif (in_array($file_ext, $permited) === false) {
                            echo "<span class='error'>You an upload only:-".implode(', ', $permited)."</span>";
                        } else {
                            move_uploaded_file($file_temp, $uploaded_image);

                            $query = "INSERT INTO tbl_event(eventName, body, image, address, location, date, time, type) VALUES ('$eventName','$body','$uploaded_image','$address','$location','$date','$time','$type')";
                            

                            $query = "UPDATE tbl_event
                                        SET
                                        eventName       = '$eventName',
                                        body            = '$body',
                                        image           = '$uploaded_image',
                                        address         = '$address',
                                        location        = '$location',
                                        date            = '$date',
                                        time            = '$time',
                                        type            = '$type'
                                        WHERE eventId   = '$id'";
                            $updated_row = $this->db->update($query);

                            $query2 = "INSERT INTO tbl_event_backup(eventName, body, image, address, location, date, time, type) VALUES ('$eventName','$body','$uploaded_image','$address','$location','$date','$time','$type')";
                            

                            $query2 = "UPDATE tbl_event_backup
                                        SET
                                        eventName       = '$eventName',
                                        body            = '$body',
                                        image           = '$uploaded_image',
                                        address         = '$address',
                                        location        = '$location',
                                        date            = '$date',
                                        time            = '$time',
                                        type            = '$type'
                                        WHERE eventId   = '$id'";
                            $updated_row = $this->db->update($query2);

                            if ($updated_row) {
                                $msg = "<span class='success'>Event Updated Successfully.</span>";
                                return $msg;
                            } else{
                                $msg = "<span class='error'>Event Not Updated.</span>";
                                return $msg;
                            }
                        } 
                    }else {

                        $query = "INSERT INTO tbl_event(eventName, body, image, address, location, date, time, type) VALUES ('$eventName','$body','$uploaded_image','$address','$location','$date','$time','$type')";
                        

                        $query = "UPDATE tbl_event
                                    SET
                                    eventName       = '$eventName',
                                    body            = '$body',
                                    address         = '$address',
                                    location        = '$location',
                                    date            = '$date',
                                    time            = '$time',
                                    type            = '$type'
                                    WHERE eventId = '$id'";
                        $updated_row = $this->db->update($query);

                        $query2 = "INSERT INTO tbl_event_backup(eventName, body, image, address, location, date, time, type) VALUES ('$eventName','$body','$uploaded_image','$address','$location','$date','$time','$type')";
                        

                        $query2 = "UPDATE tbl_event_backup
                                    SET
                                    eventName       = '$eventName',
                                    body            = '$body',
                                    address         = '$address',
                                    location        = '$location',
                                    date            = '$date',
                                    time            = '$time',
                                    type            = '$type'
                                    WHERE eventId = '$id'";
                        $updated_row = $this->db->update($query2);

                        if ($updated_row) {
                            $msg = "<span class='success'>Event Updated Successfully.</span>";
                            return $msg;
                        } else{
                            $msg = "<span class='error'>Event Not Updated.</span>";
                            return $msg;
                        }
                        }
        }
        }


        public function delEventById($id){
            $query = "SELECT * FROM tbl_event WHERE eventId = '$id'";
            $getData = $this->db->select($query);
            if($getData) {
                while ($delImg = $getData->fetch_assoc()) {
                    $dellink = $delImg['image'];
                    unlink($dellink);
                }
            }

            $delquery = "DELETE FROM tbl_event WHERE eventId = '$id'";
            $deldata = $this->db->delete($delquery);
            if ($deldata) {
                $msg = "<span class='success'>Event Deleted Successfully.</span>";
                        return $msg;
            } else {
                $msg = "<span class='error'>Event Not Deleted !</span>";
                        return $msg;
            }
        }
        public function getFeatureEvent(){
            $query  = "SELECT * FROM tbl_event WHERE type='0' ORDER BY eventId DESC LIMIT 26";
            $result = $this->db->select($query);
            return $result; 
        }

        public function getNewEvent(){
            $query  = "SELECT * FROM tbl_event ORDER BY eventId DESC LIMIT 26";
            $result = $this->db->select($query);
            return $result;
        }

        public function getSingleEvent($id){
            $query = "SELECT e.*
                        FROM tbl_event as e
                        WHERE e.eventId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        /*
        public function liveSearch($search){
            
            $query  = "SELECT * FROM tbl_event WHERE eventName LIKE '%$search%'";
            $getdata = $this->db->select($query);
            if ($getdata) {
                $data = "";
                $data .='<table class="tblone"><tr>
                            <th>Event Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Address</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Stutes</th>
                            </tr>';
                            while ($result = $getdata->fetch_assoc()) {
                                $data .='<tr>
                                        <td>'.$result["eventName"].'</td>
                                        <td>'.$result["body"].'</td>
                                        <td>'.$result["image"].'</td>
                                        <td>'.$result["address"].'</td>
                                        <td>'.$result["location"].'</td>
                                        <td>'.$result["date"].'</td>
                                        <td>'.$result["time"].'</td>
                                        <td>'.$result["type"].'</td>
                                </tr>';
                            }
                            echo $data;
            } else {
                echo "Data not found";
            }
        }
        */
       
    }
        
?>