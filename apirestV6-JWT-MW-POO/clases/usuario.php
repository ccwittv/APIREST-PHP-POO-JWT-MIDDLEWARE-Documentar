<?php
class usuario
{
	public $id;
 	public $nombre;
  	public $apellido;
  	public $mail;
  	public $pass;
  	public $nusuario;
  	public $habilitado;

    public static function TraerTodoLosUsuarios()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre, apellido, mail, pass, nusuario, habilitado from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	 }	

	public static function TraerUnUsuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre, apellido, mail, pass, nusuario, habilitado from usuarios where id = $id");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				
			
	} 
	public static function TraerUnUsuarioParametros($usermail) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			/*$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios where (mail=:usermail || nusuario=:usermail)");*/
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios where mail=:usermail");
			$consulta->bindValue(':usermail', $usermail, PDO::PARAM_STR);
			$consulta->execute();
			if ($consulta->rowCount() == 0)
			 {
			 	$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios where nusuario=:usermail");
			 	$consulta->bindValue(':usermail', $usermail, PDO::PARAM_STR);
				$consulta->execute();
			 }	
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				
			
	} 

	public function InsertarElUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,apellido,mail,pass,nusuario,habilitado)values(:nombre,:apellido,:mail,:pass,:nusuario,:habilitado)");
				$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
				$consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
				$consulta->bindValue(':pass', $this->pass, PDO::PARAM_STR);
				$consulta->bindValue(':nusuario', $this->nusuario, PDO::PARAM_STR);
				$consulta->bindValue(':habilitado', $this->habilitado, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }

	public function BorrarUsuario()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuarios 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public function ModificarUsuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set nombre=:nombre,
				apellido=:apellido,
				mail=:mail,
				pass=:pass,
                nusuario=:nusuario,
                habilitado=:habilitado
				WHERE id=:id");
			$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
			$consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
			$consulta->bindValue(':pass', $this->pass, PDO::PARAM_STR);
			$consulta->bindValue(':nusuario', $this->nusuario, PDO::PARAM_STR);
			$consulta->bindValue(':habilitado', $this->habilitado, PDO::PARAM_STR);
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			return $consulta->execute();
	 }  

}
 ?> 	