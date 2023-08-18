<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');

?>
<?php
class User{
    private $db;
    private $fm;
    
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function userRegistration($data){
        $name       = mysqli_real_escape_string($this->db->link, $data['name']);
        $address    = mysqli_real_escape_string($this->db->link, $data['address']);
        $city       = mysqli_real_escape_string($this->db->link, $data['city']);
        $country    = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip        = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone      = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email      = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass       = mysqli_real_escape_string($this->db->link, md5($data['pass']));

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {
            $msg = "<span class='error'>Fields Must Not be Empty.</span>";
            return $msg;
        }
        $mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        if ($mailchk != false) {
            $msg = "<span class='error'>Email Already Exist.</span>";
            return $msg;
        } else{
            $query = "INSERT INTO tbl_user(name, address, city, country, zip, phone, email, pass) VALUES ('$name','$address','$city','$country','$zip','$phone','$email','$pass')";

                $inserted_row = $this->db->insert($query);
                if ($inserted_row) {
                    $msg = "<span class='success'>User Data Inserted Successfully.</span>";
                    return $msg;
                } else{
                    $msg = "<span class='error'>User Data Not Inserted.</span>";
                    return $msg;
                }
        }
    }
    public function userLogin($data){
        $email       = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass       = mysqli_real_escape_string($this->db->link, md5($data['pass']));
        if (empty($email) || empty($pass)) {
            $msg = "<span class='error'>Fields Must Not be Empty.</span>";
            return $msg;
        }
        $query = "SELECT * FROM tbl_user WHERE email ='$email' AND pass='$pass'";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("userlogin", true);
            Session::set("userId", $value['id']);
            Session::set("userName", $value['name']);
            header("Location:login.php");

        } else{
            $msg = "<span class='error'>Email or Password Not matched !</span>";
            return $msg;
        }
    }

    public function getUserData($id){
        $query  = "SELECT * FROM tbl_user WHERE Id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function userUpdate($data, $userId){
        $name       = mysqli_real_escape_string($this->db->link, $data['name']);
        $address    = mysqli_real_escape_string($this->db->link, $data['address']);
        $city       = mysqli_real_escape_string($this->db->link, $data['city']);
        $country    = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip        = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone      = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email      = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" ) {
            $msg = "<span class='error'>Fields Must Not be Empty.</span>";
            return $msg;
        } else{
            $query = "UPDATE tbl_user
            SET
            name    = '$name',
            address = '$address',
            city    = '$city',
            country = '$country',
            zip     = '$zip',
            phone   = '$phone',
            email   = '$email' 
            WHERE id = '$userId'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            $msg = "<span class='success'>User Data Updated Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>User Data Not Updated !</span>";
            return $msg;
        }
        } 
    }
}

?>