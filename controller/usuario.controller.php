<?php
require_once ('model/usuario.model.php');

class UsuarioController{
	private $Umodel;

	public function __CONSTRUCT(){
		$this->Umodel = new UsuarioModel();
	}

	public function mainPage(){
		require_once ('views/include/header.php');
		require_once ('views/modules/mod_usuario/main_usuario.php');
		require_once ('views/include/footer.php');

	}

public function viewCreate()
	{
		$class = 'class = "registro"';
		require_once("views/include/header_movil.php");
		require_once("views/modules/mod_usuario/inser_usuario.php");
		require_once("views/include/footer.php");
	}



	public function create(){
		    $data = $_POST["data"];
				if(strlen($data[9]) < 8){
		       $msn= "La clave debe tener al menos 8 caracteres";
					 header("Location: index.php?c=usuario&a=viewCreate&msn=$msn");
					 }
					 elseif(!preg_match('`[a-z]`',$data[9])){
				      $msn = "La clave debe tener al menos una letra minúscula";
				      header("Location: index.php?c=usuario&a=viewCreate&msn=$msn");
	 					 }
						 /*elseif(!preg_match('`[/-\-*-+-%-&-@-¡-!|]`',$data[9])){
						      $msn = "La clave debe tener al menos un simbolo";
						      header("Location: index.php?c=usuario&a=viewCreate&msn=$msn");
								}*/
						 elseif(!preg_match('`[0-9]`',$data[9])){
					      $msn = "La clave debe tener al menos un numero";
					      header("Location: index.php?c=usuario&a=viewCreate&msn=$msn");
		 					 }
					 elseif($data[9]!==$data[11]){
			 		       $msn= "Las contraseñas no coinciden";
			 					 header("Location: index.php?c=usuario&a=viewCreate&msn=$msn");
							 }

					 else{

						if(isset($_SESSION["_usu_rol"])){
					/*		if($_SESSION["_usu_rol"]!= "ROL-ADMIN-DEF"){
								$data[5] = "ROL-VISIT-DEF";
							}*/

							if($_SESSION["_usu_rol"]!= "rol_admin_def"){
								$data[5] = "rol_admin_def";
							}
						}else{
							$data[5] = "rol_visit_def";
						}
						if(isset($_SESSION["_usu_codigo"])){
						if($_SESSION["_usu_codigo"]!= "usu_admin_def"){
							$data[6] = "usu_admin_def";
						}
					}else{
						$data[6] = "usu_visit_def";
					}

            $result = $this->Umodel->createUsuario($data);
            header("Location: index.php?c=usuario&msn=$result");
						}


	}
	public function validEmail(){
        $email[2] = $_POST["usu_mail"];
        $response = $this->users->readUserbyEmail($email);

        if(count($response[0])<=0){
          $return = array("El correo ya existe en nuestra aplicación",false);
        }else{
          $return = array("",true);
        }
        echo json_encode($return);
    }


	public function read(){
		require_once("views/include/header.php");
		require_once("views/modules/mod_usuario/read_usuario.php");
		require_once("views/include/footer.php");
	}

	public function update(){
		  $field = $_GET["usucode"];
          require_once 'views/include/header.php';
          require_once 'views/modules/mod_usuario/update_usuario.php';
          require_once 'views/include/footer.php';

	}
	public function updateData(){
        	$data = $_POST["data"];
            $result = $this->Umodel->updateUsuario($data);
            header("Location: index.php?c=usuario&msn=$result");
    }
    public function delete(){
            $data = $_GET["usucode"];
            $result = $this->Umodel->deleteUsuario($data);
            header("Location: index.php?c=usuario&msn=$result");
        }
				/*
				public function phpmailer(){
		            $data = $_GET["usucode"];
		            $result = $this->Umodel->deleteUsuario($data);
		            header("Location: index.php?c=usuario&msn=$result");
		        }*/
}

?>
