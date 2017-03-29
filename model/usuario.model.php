<?php

/*require_once ('model/views/assets/random/random.php');*/
Class UsuarioModel {
	private $pdo;
    private static $token;

	function __CONSTRUCT()
	{
		try {
			$this->pdo = DataBase::connect();
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOExepcion $e){
			die($e->getMessage()."".$e->getLine()."".$e->getFile());
		}
	}
	public function createUsuario($data){
            try {
                $sql = "INSERT INTO mzscann_usuarios (usu_nombre_comp,usu_sexo,usu_mail,rol_codigo,usu_codigo) VALUES(?,?,?,?,?)";
                $query = $this->pdo->prepare($sql);
                $query->execute(array($data[0],$data[1],$data[2],$data[5],$data[6]));
								$msn = "Usuario guardado correctamente";
            } catch (PDOException $e) {
                die($e->getMessage()."".$e->getLine()."".$e->getFile());
            }
						return $msn;

        }

				public function readUsuarioEmail($data){
			try{

				$sql = "SELECT mzscann_usuarios.usuario_codigo, usu_nombre_comp, acc_token, acc_clave FROM mzscann_usuarios INNER JOIN mzscann_acceso ON mzscann_acceso.usuario_codigo = mzscann_usuarios.usuario_codigo WHERE usu_mail = ?";
				$query = $this->pdo->prepare($sql);
				$query->execute(array($data[0]));
				$result = $query->fetch(PDO::FETCH_BOTH);

			}catch (PDOException $e) {
			die($e->getMessage());
		}

		return $result;
	}


    public function readRol(){
            try {
                $sql="SELECT * FROM mzscann_roles ORDER BY rol_nombre";
                $query = $this->pdo->prepare($sql);
                $query->execute();
                $result = $query->fetchALL(PDO::FETCH_BOTH);

                return $result;
            } catch (PDOException $e) {
                die($e->getMessage()."".$e->getLine()."".$e->getFile());

            }
        }
    public function readUsuario(){
        try {
            $sql = "SELECT * FROM mzscann_usuarios ORDER BY usu_codigo";
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $result = $query->fetchALL(PDO::FETCH_BOTH);
            return $result;
        }catch (PDOException $e) {
            die($e->getMessage()."".$e->getLine()."".$e->getFile());
        }
    }/*
		public static phpmailer($data){

			 require 'PHPMailerAutoload.php';

			 $mail = new PHPMailer;



			 $mail->isSMTP();                                      // Set mailer to use SMTP
			 $mail->Host = 'smtp1.gmail.com;';  // Specify main and backup SMTP servers
			 $mail->SMTPAuth = true;                               // Enable SMTP authentication
			 $mail->Username = 'ana@gmail';                 // SMTP username
			 $mail->Password = '123456';                           // SMTP password
			 $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			 $mail->Port = 587;                                    // TCP port to connect to

			 $mail->setFrom('ana@gmail', 'Recuperar contrasena');
			 $mail->addAddress($data[2]);     // Add a recipient
			               // Name is optional
			 $mail->addReplyTo('info@example.com', 'Information');
			 $mail->addCC('cc@example.com');
			 $mail->addBCC('bcc@example.com');


			 $mail->isHTML(true);                                  // Set emasil format to HTML



			 $mail->Body    = '<a href="http://localhost/DIANA_TAMAYO&cod='".$data[token]."'">';


			 if(!$mail->send()) {
			     echo 'Message could not be sent.';
			     echo 'Mailer Error: ' . $mail->ErrorInfo;
			 } else {
			     echo 'Message has been sent';
 			 }
		}*/
    public function readUsuarioByCode($field){
            try {
                $sql="SELECT * FROM mzscann_usuarios WHERE usu_codigo = ?";
                $query = $this->pdo->prepare($sql);
                $query->execute(array($field));
                $result = $query->fetch(PDO::FETCH_BOTH);
                return $result;
            } catch (PDOException $e) {
                die($e->getMessage()."".$e->getLine()."".$e->getFile());
            }

        }
    public function updateUsuario($data){
            try {
                $sql="UPDATE mzscann_usuarios SET usu_nombre_comp = ?, usu_fech_naci = ?, usu_sexo = ?, usu_tel_cel = ?, usu_mail = ?, rol_codigo = ? WHERE usu_codigo = ?";
                $query = $this->pdo->prepare($sql);
                $query->execute(array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6]));

                $msn = "Modifico con exito!";
            } catch (PDOException $e) {
                die($e->getMessage()."".$e->getLine()."".$e->getFile());
            }
            return $msn;
        }

    public function deleteUsuario($field){
            try {
                $sql = "DELETE FROM mzscann_usuarios WHERE usu_codigo = ?";
                $query = $this->pdo->prepare($sql);
                $query->execute(array($field));
                $msn = "Eliminado correctamente!";
            } catch (PDOException $e) {
                die($e->getMessage()."".$e->getLine()."".$e->getFile());
            }
            return $msn;
        }

    public function __DESTRUCT(){

            DataBase::disconnect();
        }
}

?>
