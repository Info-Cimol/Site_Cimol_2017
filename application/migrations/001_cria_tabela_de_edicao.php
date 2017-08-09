<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Cria_tabela_de_edicao extends CI_Migration{

	public function up(){
		$this->dbforge->add_field(array(
			"id" => array(
				"type" => "INT",
				"auto_increment" => TRUE
			),

			"edicao" => array(
				"type" => "INT",
			),

			"ano" => array(
				"type" => "INT"
			)

		));

		$this->dbforge->add_key("id",TRUE);
		$this->dbforge->create_table("feintec_edicao");
	}

	public function down(){
		$this->dbforge->drop_table("feintec_edicao");
	}

}
