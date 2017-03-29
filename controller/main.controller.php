
<?php
require_once 'model/login.model.php';

class MainController{

    private $Lmodel;

    public function __CONSTRUCT(){
        $this->Lmodel = new LoginModel();
    }
		public function mainPage(){
	$class= 'class ="login"';

/*	if(isset($_SESSION["_usu_codigo"])){
		header("Location: index.php?c=main&a=dashboard");
	}
	*/
	require_once("views/include/header_movil.php");
	require_once("views/login.php");
	require_once("views/include/footer.php");
}
public function dashboard(){
	require_once("views/include/header_movil.php");
	require_once("views/dashboard.php");
	require_once("views/include/footer.php");
}

    // Metodo para validar que el correo si exista en la base de datos (este metodo lo invoca el javascript)
    public function validarEmail(){
        $email[0] = $_POST["email"];
        $response = $this->Lmodel->readUsuarioEmail($email);

        if(count($response[0])<=0){
          $return = array("El correo no existe en nuestra aplicación",false);
        }else{
          $return = array("",true);
        }
        echo json_encode($return);
    }

    // Metodo para cerrar sesion
    public function logout(){
        session_destroy();
        header("Location: inicio");
    }

    // Metodo para autenticar y validar el usuario por medio de la contraseña
    public function login(){
      $result = $this->Lmodel->compruebaLogin($data);


    if(password_verify($data[1],$result["acc_clave"])){
         $return = array(true,"Bienvenido al Sistema");

         //  Creamos las variables de Sesion
         $_SESSION["_usu_token"] = $result["acc_token"];
         $_SESSION["_usu_codigo"]  = $result["usu_codigo"];
         $_SESSION["_usu_nombre"] = $result["usu_nombre_comp"];
         $_SESSION["_usu_mail"] = $result["usu_mail"];
				 $_SESSION["_usu_rol"]		= $result["rol_codigo"];

      }else{
 				$return = array(false,"La contraseña no es la correcta");

      }

      echo json_encode($return);

    }
}
?>
