<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Usuarios extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	// Plural
	public function ObtenerUsuarios()
	{
		$this->db->select("u.Id, 
			CONCAT(u.Nombre, ' ', u.Ap_pa, ' ', u.Ap_ma) AS Nombre,
			IF( c_ele.Elemento = 'Administrador', 'Admin', c_ele.Elemento) AS TipoUsuario,
			SUM( IF( e.Nombre IS NULL, 0, 1) ) AS nEmpresas
		");
		$this->db->from('Usuarios AS u');
		$this->db->join('Empresas AS e', 'u.Id = e.IdUsuario', 'LEFT');
		$this->db->join('CatElementos as c_ele', 'u.IdCatTipoUsuario = c_ele.Id', 'INNER');
		$this->db->group_by('u.Id, Nombre, TipoUsuario');
		return $this->db->get()->result_array();
	}
	// END Plural

	// Singular
	public function ObtenerUsuario($viewInfo)
	{
		$this->db->select("usu.Id, usu.Nombre, usu.Ap_pa, usu.Ap_ma,
						CONCAT(usu.Nombre, ' ', usu.Ap_pa, ' ', usu.Ap_ma) AS NombreCompleto,
						usu.IdCatSexo, catSex.Elemento AS Sexo, Correo, Password,
						catTipUsu.Elemento AS TipoUsuario, usu.IdCatTipoUsuario");
		$this->db->from('Usuarios AS usu');
		$this->db->join('CatElementos AS catSex', 'catSex.Id = usu.IdCatSexo', 'inner');
		$this->db->join('CatElementos AS catTipUsu', 'catTipUsu.Id = usu.IdCatTipoUsuario', 'inner');
		$this->db->where('usu.Id', $viewInfo['Id']);
		return $this->db->get()->result_array()[0];
	}
	// END Singular

	// Guardar
	public function GuardarUsuario($viewInfo)
	{
		$viewInfo['FA'] = date('Y-m-d H:i:s');
		if ($viewInfo['Id'] == 0) {
			$viewInfo['FR'] = $viewInfo['FA'];
			return ($this->db->insert('Usuarios', $viewInfo)) ? true : false;
			//$this->db->insert('Usuarios', $viewInfo);

			return $this->db->_error_number();
		} else {
			$this->db->where('Id', $viewInfo['Id']);
			return ($this->db->update('Usuarios', $viewInfo)) ? true : false;
		}
	}
	// END Guardar

	// Eliminar
	public function EliminarUsuario($viewInfo)
	{
			//Iniciamos la transacción.    
			$this->db->trans_begin();    

						// Eliminamos al usuario
						$this->db->where('Id', $viewInfo['Id']);
						$this->db->delete('Usuarios', $viewInfo);

						// Volvemos a Cero todas las empresas relacionadas a el
						$this->db->where('IdUsuario', $viewInfo['Id']);
						$this->db->update('Empresas', array('IdUsuario' => 0 ) );

			if(	$this->db->trans_status() === FALSE ){
					//Hubo errores en la consulta, entonces se cancela la transacción.
					$this->db->trans_rollback();
					return false;
			}else{
					//Todas las consultas se hicieron correctamente.
					$this->db->trans_commit();
					return true;
			}
	}
	// END Eliminar


	public function ObtenerUsuario_Logueado($viewInfo)
	{
		//return $viewInfo;


		$this->db->select("
			usu.Id AS IdUsuario, 
			usu.IdCatTipoUsuario, 
			CONCAT(usu.Nombre, ' ', usu.Ap_pa, ' ', usu.Ap_ma) AS Nombre
		");
		$this->db->from('Usuarios AS usu');
		$this->db->where('usu.Correo',	$viewInfo['Correo']);
		$this->db->where('usu.Password',$viewInfo['Password']);
		$tmp = $this->db->get()->result_array();
		return (count( $tmp ) > 0) ? $tmp[0] : false;
	}



	public function Obtener_Mis_Empresas( $viewInfo )
	{
		$this->db->select('Id AS IdEmpresa, Nombre AS Empresa, 1 As Mover');
		$this->db->from('Empresas');
		$this->db->where('IdUsuario', $viewInfo['IdUsuario']);
		$this->db->order_by('Empresa');
		return $this->db->get()->result_array();
	}

	public function Obtener_Empresas_Registradas( $viewInfo )
	{
		$this->db->select('Id AS IdEmpresa, Nombre AS Empresa, IF( IdUsuario = 0, 1, 0) As Mover');
		$this->db->from('Empresas');
		$this->db->where('IdUsuario !=', $viewInfo['IdUsuario']);
		$this->db->order_by('Mover', "DESC");
		$this->db->order_by('Empresa');
		return $this->db->get()->result_array();
	}

	public function GuardarRelacion_UsuarioEmpresa( $viewInfo ){
			return ( $this->db->update_batch('Empresas', $viewInfo, 'Id') ) ? true : false;
			// return $this->db->last_query();
	}
}

/* End of file M_Usuarios.php */
/* Location: ./application/models/mi_empresa/M_Usuarios.php */
