<?php
  require_once 'usuario.php';
  require_once 'rol.php';
  require_once 'tiporol.php';
  require_once "AutentificadorJWT.php";
  class loginApi
   {
     public $usermail;
     public $pass;

     	public function Ingreso($request, $response, $args)
     	 {
          $objDelaRespuesta= new stdclass();
          $ArrayDeParametros = $request->getParsedBody();
          //var_dump($ArrayDeParametros);
          $usermail= $ArrayDeParametros['usermail'];
          $pass= sha1($ArrayDeParametros['pass']);
          //$pass= $ArrayDeParametros['pass'];  

          $miusuario = usuario::TraerUnUsuarioParametros($usermail);

          if($miusuario->pass == $pass)
          //if($miusuario->pass == $pass) 
			     {				
            $rolmiusuario =  rol::TraerRolUsuario($miusuario->id);
            $tiporolmiusuario =  tiporol::TraerTipoRolUsuario($rolmiusuario->idrol);
				    $datos = array('usuario' => $miusuario->mail,'perfil' => 
				    $tiporolmiusuario->descripcion , 'alias' => $miusuario->nusuario);
			     //$token= AutentificadorJWT::CrearTokenParametros($datos,$pass);
            $token= AutentificadorJWT::CrearToken($datos);
			      $arrayConToken["MiTokenGeneradoEnPHP"] = $token;
     	 	   }
     	    else 
     	      {
     	   		 $arrayConToken["MiTokenGeneradoEnPHP"] = false;
     	   	  }

     	   	//echo json_encode($arrayConToken);	

     	   	$objDelaRespuesta->respuesta=$datos;
			    $objDelaRespuesta->elToken=$token;	
     	   	return $response->withJson($objDelaRespuesta, 401);  
   		}

  }
?>