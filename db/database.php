<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function checkLogin($username, $password){
        $query = "SELECT username, name, email FROM user WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }     

    public function emailAlreadyTaken($email){
        $query = "SELECT * FROM user U WHERE U.email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

    public function usernameAlreadyTaken($username){
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function registerUser($username, $email, $password){
        $query = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss',$username, $email, $password);
        $stmt->execute();
    }

    //post degli utenti seguiti dall'utente denominato "?", ordinati per data di pubblicazione in ordine decrescente
    public function friendsPosts($user) {
        $stmt = $this->db->prepare("SELECT * FROM post P JOIN follow ON P.username = follow.followed WHERE follow.follower = ? ORDER BY P.time DESC");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function postsComment($post) {
        $stmt = $this->db->prepare("SELECT C.user, C.text FROM comment C WHERE C.post = ?");
        $stmt->bind_param('i', $post);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isPostLiked($user, $post) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS conta FROM like_post WHERE user = ? AND post = ?");
        $stmt->bind_param('si', $user, $post);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["conta"];
    }

    public function getUserProfileImage($username){
        $query = "SELECT imgProfile FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($profile_image);
        $stmt->fetch();
        $stmt->close();
    
        return $profile_image;
    }
}
?>