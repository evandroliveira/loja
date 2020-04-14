<?php
class users extends model {

	private $uid;
    private $permissions;
	private $userName;
	
	public function getAll() {
		$array = array();

		$sql = "SELECT * FROM contatos";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function get($id) {
		$array = array();

		$sql = "SELECT * FROM users WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function isLogged() {   

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
				//print_r($this->userName);exit;
                return true;
            }
        }

        return false;
	}
	
	
	public function getName() {
		
        return $this->userName;
	}
	
	public function getId() {
        return $this->uid;
	}
	
	public function getUser() {

	}

    public function validateLogin($email, $password = array()) {

        $sql = "SELECT id FROM users WHERE email = :email AND password = :password AND admin = 0";
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
			$_SESSION['name'] = $email;
			
            return true;
        } else {
			unset($_SESSION['name']);
		}

        return false;
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

	public function createUser($email, $name, $pass, $cpf, $telefone, $cep, $cidade, $estado, $rua, $numero, $complemento, $bairro) {

		$sql = "INSERT INTO users (email, name, password, cpf, telefone, cep, cidade, estado, rua, numero, complemento, bairro) VALUES (:email, :name, :pass, :cpf, :telefone, :cep, :cidade, :estado, :rua, :numero, :complemento, :bairro)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":pass", md5($pass));
		$sql->bindValue(":cpf", $cpf);
		$sql->bindValue(":telefone", $telefone);
		$sql->bindValue(":cep", $cep);
		$sql->bindValue(":cidade", $cidade);
		$sql->bindValue(":estado", $estado);
		$sql->bindValue(":rua", $rua);
		$sql->bindValue(":numero", $numero);
		$sql->bindValue(":complemento", $complemento);
		$sql->bindValue(":bairro", $bairro);
		$sql->execute();

		return $this->db->lastInsertId();

	}












}