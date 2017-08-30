<?php
class rol
{
   public $id;
   public $idrol;
   public $idusuario;

public function InsertarElRolalUsuarioParametros()
	 {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into roles (idrol,idusuario)values(:idrol,:idusuario)");
		$consulta->bindValue(':idrol',$this->idrol, PDO::PARAM_INT);
		$consulta->bindValue(':idusuario', $this->idusuario, PDO::PARAM_INT);		
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }

public function BorrarRolaUsuario()
	 {
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from roles 				
				WHERE idusuario=:idusuario");	
				$consulta->bindValue(':idusuario',$this->idusuario, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }	 

}
?> 