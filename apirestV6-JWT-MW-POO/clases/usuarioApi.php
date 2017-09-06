<?php
require_once 'rol.php';
require_once 'usuario.php';
require_once 'IApiUsable.php';

class usuarioApi extends usuario implements IApiUsable
{
 	
    public function TraerUno($request, $response, $args) {
       $id=$args['id'];
        $elUsuario=usuario::TraerUnUsuario($id);
        if(!$elUsuario)
        {
            $objDelaRespuesta= new stdclass();
            $objDelaRespuesta->error="No esta El Usuario";
            $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
        }else
        {
            $NuevaRespuesta = $response->withJson($elUsuario, 200); 
        }     
        return $NuevaRespuesta;
     }

    public function TraerTodos($request, $response, $args) {
      	$todosLosUsuarios=usuario::TraerTodoLosUsuarios();
     	$newresponse = $response->withJson($todosLosUsuarios, 200);  
    	return $newresponse;
    }

    public function CargarUno($request, $response, $args) {

        $objDelaRespuesta= new stdclass();
        
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $mail= $ArrayDeParametros['mail'];
        $pass= sha1($ArrayDeParametros['pass']);
        //$pass= sha1($ArrayDeParametros['pass']);  
        $nusuario= $ArrayDeParametros['nusuario'];
        $habilitado= $ArrayDeParametros['habilitado'];        
        
        $miusuario = new usuario();
        $miusuario->nombre=$nombre;
        $miusuario->apellido=$apellido;
        $miusuario->mail=$mail;
        $miusuario->pass=$pass;
        $miusuario->nusuario=$nusuario;
        $miusuario->habilitado=$habilitado;
        $objDelaRespuesta->idGenerado = $miusuario->InsertarElUsuarioParametros();
        //var_dump($objDelaRespuesta->idGenerado);
        if (isset($objDelaRespuesta->idGenerado))
          {
            /*Si se generó el id de usuario se carga dicho usuario con el rol de usuario final*/
            $rolUsuario = new rol();
            $rolUsuario->idrol = 1;
            $rolUsuario->idusuario = $objDelaRespuesta->idGenerado;
            $rolUsuario->InsertarElRolalUsuarioParametros();            
          }
        
//Carga de la foto
        $archivos = $request->getUploadedFiles();
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);
        if(isset($archivos['foto']))
        {
            $nombreAnterior=$archivos['foto']->getClientFilename();
            $extension= explode(".", $nombreAnterior)  ;
            //var_dump($nombreAnterior);
            $extension=array_reverse($extension);
            $archivos['foto']->moveTo($destino.$titulo.".".$extension[0]);
        }       
        
        //$response->getBody()->write("se guardo el cd");
        $objDelaRespuesta->respuesta="Se guardo el Usuario.";   
        return $response->withJson($objDelaRespuesta, 200);

     } 

    public function BorrarUno($request, $response, $args) {

      $ArrayDeParametros = $request->getParsedBody();
      $id=$ArrayDeParametros['id'];
      $usuario= new usuario();
      $usuario->id=$id;
      
      $cantidadDeBorrados=$usuario->BorrarUsuario();
      $objDelaRespuesta= new stdclass();
      
      $objDelaRespuesta->cantidad=$cantidadDeBorrados;
      if($cantidadDeBorrados>0)
        {
           $rolUsuario = new rol();
           $rolUsuario->idusuario = $id;           
           $rolUsuario->BorrarRolaUsuario();            

           $objDelaRespuesta->resultado="algo borro!!!";
        }
        else
        {
          $objDelaRespuesta->resultado="no Borro nada!!!";
        }
      $newResponse = $response->withJson($objDelaRespuesta, 200);  
      return $newResponse;

     } 
     
    public function ModificarUno($request, $response, $args) {

         //$response->getBody()->write("<h1>Modificar  uno</h1>");
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);     
        
        $miusuario = new usuario();
        $miusuario->id=$ArrayDeParametros['id'];
        $miusuario->nombre=$ArrayDeParametros['nombre'];
        $miusuario->apellido=$ArrayDeParametros['apellido'];
        $miusuario->mail=$ArrayDeParametros['mail'];
        $miusuario->pass=sha1($ArrayDeParametros['pass']);
        //$miusuario->pass=$ArrayDeParametros['pass']);
        $miusuario->nusuario=$ArrayDeParametros['nusuario'];
        $miusuario->habilitado=$ArrayDeParametros['habilitado'];

        //var_dump($miusuario);
        $resultado =$miusuario->ModificarUsuarioParametros();
        $objDelaRespuesta= new stdclass();
      //var_dump($resultado);
        $objDelaRespuesta->resultado=$resultado;
        $objDelaRespuesta->tarea="modificar";
        return $response->withJson($objDelaRespuesta, 200); 

     }   
 }
 
 ?>   