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
        $query = "SELECT username, name, email, password FROM user WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getUserByUsername($username){
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0];
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

    public function registerUser($username, $email, $password, $profilePicPath) {
        $query = "INSERT INTO user (username, email, password, imgProfile) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $username, $email, $password, $profilePicPath);
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
        $stmt = $this->db->prepare("SELECT C.user, C.text, U.imgProfile, C.time, C.nLike, C.idComment FROM comment C JOIN user U ON C.user = U.username WHERE C.post = ?");
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
        $sql = "INSERT INTO like_post (post, user) VALUES (?, ?)";

        $stmt = $this -> db-> prepare($sql);
        $stmt->bind_param("is", $post, $user);
        $stmt->execute();

        $sql2 = "UPDATE post
        SET nLike = (SELECT COUNT(*) FROM like_post WHERE post = ?)
        WHERE idPost = ?
        ";
        $stmt2 = $this -> db-> prepare($sql2);
        if (!$stmt2) {
            die("Errore nella preparazione della query: " . $this->db->error);
        }
        $stmt2->bind_param("ii", $post, $post);
        $stmt2->execute();
    }  

    public function unlikesPost($post, $user) {
        $sql = "DELETE FROM like_post WHERE post = ? AND user = ?";

        $stmt = $this -> db-> prepare($sql);
        $stmt->bind_param("is", $post, $user);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $sql2 = "UPDATE post SET nLike = (SELECT COUNT(*) FROM like_post WHERE post = ?) WHERE idPost = ?";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bind_param("ii", $post, $post);
            $stmt2->execute();
        }
    }

    public function likesComment($comment, $user) {
        $sql = "INSERT INTO like_comment (comment, user) VALUES (?, ?)";
        $stmt = $this -> db-> prepare($sql);
        $stmt->bind_param("is", $comment, $user);
        $stmt->execute();

        $sql2 = "UPDATE comment
        SET nLike = (SELECT COUNT(*) FROM like_comment WHERE comment = ?)
        WHERE idComment= ?
        ";

        $stmt2 = $this -> db-> prepare($sql2);
        if (!$stmt2) {
            die("Errore nella preparazione della query: " . $this->db->error);
        }
        $stmt2->bind_param("ii", $comment, $comment);
        $stmt2->execute();
    }     

    public function unlikesComment($comment, $user) {
        $sql = "DELETE FROM like_comment WHERE comment = ? AND user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $comment, $user);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            $sql2 = "UPDATE comment SET nLike = (SELECT COUNT(*) FROM like_comment WHERE comment = ?) WHERE idComment = ?";
            $stmt2 = $this->db->prepare($sql2);
            $stmt2->bind_param("ii", $comment, $comment);
            $stmt2->execute();
        }
    }    

    //1 se utente ha già messo like
    //0 se non ha messo like
    public function alreadyLikedPost($user, $post){
        $query = "SELECT EXISTS(SELECT 1 FROM like_post WHERE user = ? AND post = ?) AS exists_likeP";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $user, $post);
        $stmt->execute();
        $stmt->bind_result($exists_likeP);
        $stmt->fetch();
        
        if ($exists_likeP == 1) {
            // L'utente ha già messo "mi piace" al post
            return true;
        } else {
            // L'utente non ha ancora messo "mi piace" al post
            return false;
        }        
    }

    //1 se utente ha già messo like
    //0 se non ha messo like
    public function alreadyLikedComment($user, $comment){
        $query = "SELECT EXISTS(SELECT 1 FROM like_comment WHERE user = ? AND comment = ?) AS exists_likeC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $user, $comment);
        $stmt->execute();
        $stmt->bind_result($exists_likeC);
        $stmt->fetch();
        
        if ($exists_likeC == 1) {
            // L'utente ha già messo "mi piace" al post
            return true;
        } else {
            // L'utente non ha ancora messo "mi piace" al post
            return false;
        }        
    }
    
    public function postUser($post){
        $stmt = $this->db->prepare("SELECT P.username FROM Post P WHERE P.idPost = ?");
        $stmt->bind_param('s', $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0]["username"];
    }

    public function getFollowers($user) {
        $stmt = $this->db->prepare("SELECT follower FROM follow WHERE followed = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowersNumber($user) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS count FROM follow WHERE followed = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["count"];
    }

    public function getFollowing($user) {
        $stmt = $this->db->prepare("SELECT followed FROM follow WHERE follower = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowingNumber($user) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS count FROM follow WHERE follower = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["count"];
    }

    public function getPostsNumber($user) {
        $stmt = $this->db->prepare("SELECT count(*) AS count FROM post WHERE username = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["count"];
    }

    public function getUserBio($user) {
        $stmt = $this->db->prepare("SELECT bio FROM user WHERE user.username = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()["bio"];
    }

    public function getUserRealName($user) {
        $stmt = $this->db->prepare("SELECT name FROM user WHERE user.username = ?");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()["name"];
    }

    public function newPost($image_name, $didascalia, $timestamp, $user_id){
        // Inserisci il nuovo post nel database
        $stmt = $this->db->prepare("INSERT INTO post (image, text, time, username) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $image_name, $didascalia, $timestamp, $user_id);
        $result = $stmt->execute();
        return $result ? true : false;
    }
    
    public function writeReply($parent_comment, $user, $reply_text) {
        $stmt = $this->db->prepare("INSERT INTO replies (idComment, username, reply_text) VALUES (?, ?, ?)");
        if (!$stmt) {
            // Query preparation failed
            die("Error preparing query: " . $this->db->error);
        }
        $stmt->bind_param('iss', $parent_comment, $user, $reply_text);
    
        $result = $stmt->execute();
    
        // Verifica se l'inserimento è stato eseguito con successo
        if ($result) {
            // Aggiorna il numero di commenti nel post considerando sia i commenti diretti che le risposte
            $sql2 = "UPDATE post
            SET nComment = (
                SELECT COUNT(*) 
                FROM comment 
                WHERE post = ?
            ) + (
                SELECT COUNT(*) 
                FROM replies 
                INNER JOIN comment ON replies.idComment = comment.idComment 
                WHERE comment.post = ?
            )
            WHERE idPost = ?
            ";   
            $stmt2 = $this->db->prepare($sql2);
            if (!$stmt2) {
            // Query preparation failed
            die("Error preparing update query: " . $this->db->error);
            }
            $stmt2->bind_param("iii", $post, $post, $post);
            $stmt2->execute();
            return true;        
        } else {
            // Gestisci eventuali errori nell'inserimento della risposta nel database
            return false;
        }
    }
    
    public function writeComment($post, $user, $comment) {
        $stmt = $this->db->prepare("INSERT INTO comment (post, user, text) VALUES (?, ?, ?)");
        if (!$stmt) {
            // Query preparation failed
            die("Error preparing query: " . $this->db->error);
        }
        $stmt->bind_param('iss', $post, $user, $comment);
    
        $result = $stmt->execute();
    
        // Verifica se l'inserimento è stato eseguito con successo
        if ($result) {
            // Aggiorna il numero di commenti nel post considerando sia i commenti diretti che le risposte
            $sql2 = "UPDATE post
            SET nComment = (
                SELECT COUNT(*) 
                FROM comment 
                WHERE post = ?
            ) + (
                SELECT COUNT(*) 
                FROM replies 
                INNER JOIN comment ON replies.idComment = comment.idComment 
                WHERE comment.post = ?
            )
            WHERE idPost = ?
            ";   
            $stmt2 = $this->db->prepare($sql2);
            if (!$stmt2) {
            // Query preparation failed
            die("Error preparing update query: " . $this->db->error);
            }
            $stmt2->bind_param("iii", $post, $post, $post);
            $stmt2->execute();
            return true;        
        } else {
            // Gestisci eventuali errori nell'inserimento del commento nel database
            return false;
        }
    }
    
    public function getReplies($commentId) {
        $stmt = $this->db->prepare("SELECT * FROM replies WHERE idComment = ?");
        $stmt->bind_param('i', $commentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $replies = array();
        while ($row = $result->fetch_assoc()) {
            $replies[] = $row;
        }
        return $replies;
    }    

        public function isFollowing($follower, $followed) {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS count FROM follow WHERE follower = ? AND followed = ?");
        $stmt->bind_param('ss', $follower, $followed);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["count"] > 0;
    }

    public function removeFollowing($follower, $followed) {
        $stmt = $this->db->prepare("DELETE FROM follow WHERE follower = ? AND followed = ?");
        $stmt->bind_param('ss', $follower, $followed);
        $stmt->execute();
    }

    public function addFollowing($follower, $followed) {
        $stmt = $this->db->prepare("INSERT INTO follow (follower, followed) VALUES (?, ?)");
        $stmt->bind_param('ss', $follower, $followed);
        $stmt->execute();
    }

    public function getUserPosts($user) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE username = ? ORDER BY time DESC");
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getUsers($string){
        $stmt = $this->db->prepare("SELECT username FROM user WHERE username LIKE ?");
        $string = $string . '%';
        $stmt->bind_param('s', $string);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNewAlerts($user) {
        $stmt = $this->db->prepare("SELECT * FROM alert_ WHERE sender not like ? AND isAlertRead = 0 AND receiver = ? ORDER BY time DESC");
        $stmt->bind_param('ss', $user, $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function setViewed($alert, $loggedUser) {
        $stmt = $this->db->prepare("UPDATE alert_ t SET t.isAlertRead = 1 WHERE t.receiver LIKE 'chiara' AND t.idElement = ?");
        $stmt->bind_param('i', $alert);
        $stmt->execute();
    }

    public function getPostByElementIdAndType($alertIdElement, $alertType) {
            switch ($alertType) {
                case 'LIKE_POST':
                $stmt = $this->db->prepare("SELECT *
                                            FROM post
                                            WHERE idPost = (SELECT post
                                                            FROM like_post
                                                            WHERE like_post_id = ?);");
                    break;
                case 'LIKE_COMMENT':
                $stmt = $this->db->prepare("SELECT *
                                            FROM post
                                            WHERE idPost = (SELECT post
                                                            FROM comment
                                                            WHERE idComment = (SELECT comment
                                                                            FROM like_comment
                                                                            WHERE like_comment_id = ?));");
                break;
                case 'COMMENT_POST':
                $stmt = $this->db->prepare("SELECT *
                                            FROM post
                                            WHERE idPost = (SELECT post
                                                            FROM comment
                                                            WHERE idComment = ?);");
                break;
                case 'COMMENT_COMMENT':
                $stmt = $this->db->prepare("SELECT *
                                            FROM post
                                            WHERE idPost = (SELECT post
                                                            FROM comment
                                                            WHERE idComment = ?);");
                break;    
                default:
                    break;
            }
            $stmt->bind_param('i', $alertIdElement);                                                        
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM post WHERE idPost = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM post WHERE idPost = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function updateName($newName, $user){
        $sql = "UPDATE user SET name = ? WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $newName, $user);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }

    public function updatePassword($newPassword, $user){
        $sql = "UPDATE user SET password = ? WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $newPassword, $user);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;    
    }
    
    public function updateBio($newBio, $user){
        $sql = "UPDATE user SET bio = ? WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $newBio, $user);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;    
    }

    public function updateImgProfile($newImg, $user){
        $sql = "UPDATE user SET imgProfile = ? WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $newImg, $user);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;    
    }

    /**
     * Return 10 more posts.
     */
    public function getMorePosts($last_post_id, $user) {
        $sql = "SELECT * FROM post P JOIN follow ON P.username = follow.followed WHERE follow.follower = ? AND P.idPost < ? ORDER BY P.idPost DESC LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('si', $user, $lastPostId);
        $stmt->execute();
        $result = $stmt->get_result();


        return $result;
    }
}