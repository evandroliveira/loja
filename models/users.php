<?php
class users extends model {

	private $uid;
    private $permissions;
    private $userName;

	public function isLogged($userName) {
   

        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $sql = "SELECT id, name FROM users WHERE token = :token";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':token', $token);
            $sql->execute();

            if($sql->rowCount() > 0) {
                

                $data = $sql->fetch();
                $this->uid = $data['id'];
                $this->userName = $data['name'];
				
                return true;
            }
        }

        return false;
	}
	
	public function getName() {
		
        return $this->userName;
    }

    public function validateLogin($email, $password = array()) {

        $sql = "SELECT id FROM users WHERE email = :email AND password = :password";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", md5($password));
        $sql->execute();

        if ($sql->rowCount() > 0 ) {
            $data = $sql->fetch();
            
            $token = md5(time().rand(0,999).$data['id'].time());

            $sql = "UPDATE users SET token = :token WHERE id = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':token', $token);
            $sql->bindValue(':id', $data['id']);
            $sql->execute();

            $_SESSION['token'] = $token;            

            return true;
        }

        return false;
    }

    public function getId() {
        return $this->uid;
    }

	public function emailExists($email) {

		$sql = "SELECT * FROM users WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}

	}

	public function validate($email, $pass) {
		$uid = '';

		$sql = "SELECT * FROM users WHERE email = :email AND password = :pass";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":pass", $pass);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$uid = $sql['id'];
		}

		return $uid;
	}

	public function createUser($email, $pass) {

		$sql = "INSERT INTO users (email, password) VALUES (:email, :pass)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":pass", $pass);
		$sql->execute();

		return $this->db->lastInsertId();

	}












}