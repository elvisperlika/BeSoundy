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

    public function getPostedComment($post) {
        $stmt = $this->db->prepare("SELECT C.user, C.text, U.imgProfile, C.time, C.nLike FROM comment C JOIN user U ON C.user = U.username WHERE C.post = ?");
        $stmt->bind_param('i', $post);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
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

    public function getUserProfileComment($user){
        $query = "SELECT C.user, U.imgProfile from comment C JOIN user U ON U.username = C.user WHERE C.user = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($profile_image);
        $stmt->fetch();
        $stmt->close();
    
        return $profile_image;
    }

    public function likesPost($post, $user) {
        $sql = "UPDATE post SET nLike = nLike + 1 WHERE idPost = ?";
        $stmt = $this -> db-> prepare($sql);
        $stmt->bind_param("i", $post);
        $stmt->execute();
    }    

    public function postUser($post){
        $stmt = $this->db->prepare("SELECT P.username FROM Post P WHERE P.idPost = ?");
        $stmt->bind_param('s', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["username"];
    }

    public function writeComment($post, $user, $comment){
        $stmt = $this->db->prepare("INSERT INTO comment (post, user, text) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $post, $user, $comment);
        $stmt->execute();
    }

    public function unlikesPost($post, $user) {
        $sql = "UPDATE post SET nLike = nLike - 1 WHERE idPost = ?";
        $stmt = $this -> db-> prepare($sql);
        $stmt->bind_param("i", $post);
        $stmt->execute();
    }

    public function alreadyLikedPost($user, $post){
        $stmt = $this->db->prepare("SELECT COUNT(*) AS conta FROM like_post WHERE user = ? AND post = ?");
        $stmt->bind_param('ii', $user, $post);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["conta"];
    }
}
?>