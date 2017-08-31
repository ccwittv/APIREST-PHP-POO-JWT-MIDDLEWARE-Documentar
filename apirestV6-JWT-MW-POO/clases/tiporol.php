<?php
class tiporol
{
   public $id;
   public $descripcion;
    
   public static function TraerTipoRolUsuario($idrol)
	 {
	 	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from tiporol where id =:idrol");
		$consulta->bindValue(':idrol', $idrol, PDO::PARAM_INT);
		$consulta->execute();
		$tiporolBuscado= $consulta->fetchObject('tiporol');
		return $tiporolBuscado;	
	 }	

}
?> 