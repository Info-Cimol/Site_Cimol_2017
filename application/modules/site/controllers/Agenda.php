<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends MX_Controller{
	public function __construct(){
		$this->load->model('agenda_model');
		$this->load->model('evento_model');
		date_default_timezone_set("Brazil/East");
		parent::__construct();
	}
	
	public function index(){
		$this->data['ano']=date("Y");
		$this->data['mes']=date("m");
		$this->data['dia']=date("d");
		$data=$this->data['ano']."-".$this->data['mes']."-01";
		$this->data['primeiro_dia'] = date('w', strtotime($data));
		$this->data['eventos']=$this->evento_model->buscar_eventos_mes($this->data['mes'], $this->data['ano']);
		$this->data['eventos_agenda']=$this->agenda_model->buscar_eventos_mes($this->data['mes'], $this->data['ano']);
		$this->data['template']='agenda/index';
		$this->data['title']="Cimol - Agenda";
		$this->view->show_view($this->data);
	}

	public function buscar_evento_data($ano,$mes,$dia){
		$eventos['evento']=$this->evento_model->buscar_eventos_mes($mes, $ano, $dia);
		$eventos['agenda']=$this->agenda_model->buscar_eventos_mes($mes, $ano, $dia);
		echo json_encode($eventos);
	}

	public function agenda_ajax($ano=null, $mes=null, $dia=null){
		$data=$ano."-".$mes."-01";
		$primeiro_dia = date('w', strtotime($data));
		$eventos=$this->evento_model->buscar_eventos_mes($mes, $ano);
		$eventos_agenda=$this->agenda_model->buscar_eventos_mes($mes, $ano);
		$link=0;
		if($mes==02){
			if($ano%4==0){
				$ultimo_dia=29;
			}else{
				$ultimo_dia=28;
			}
		}else if($mes==05 || $mes==06 || $mes==09 || $mes==11){
			$ultimo_dia=30;
		}else{
			$ultimo_dia=31;
		}
		$i_for=1-$primeiro_dia;
		if($mes==1){
			?>
			<div id="calendario-mes">
			<p>Janeiro de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==2){
			?>
			<div id="calendario-mes">
			<p>Fevereiro de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==3){
			?>
			<div id="calendario-mes">
			<p>Março de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==4){
			?>
			<div id="calendario-mes">
			<p>Abril de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==5){
			?>
			<div id="calendario-mes">
			<p>Maio de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==6){
			?>
			<div id="calendario-mes">
			<p>Junho de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==7){
			?>
			<div id="calendario-mes">
			<p>Julho de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==8){
			?>
			<div id="calendario-mes">
			<p>Agosto de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==9){
			?>
			<div id="calendario-mes">
			<p>Setembro de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==10){
			?>
			<div id="calendario-mes">
			<p>Outubro de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==11){
			?>
			<div id="calendario-mes">
			<p>Novembro de <?php echo $ano?></p>
			</div>
			<?php 
		}else if($mes==12){
			?>
			<div id="calendario-mes">
			<p>Dezembro de <?php echo $ano?></p>
			</div>
			<?php 
		}
		for($i=$i_for;$i<=$ultimo_dia;$i++){
			if($i<10){
				$dia="0".$i;
			}else{
				$dia=$i;
			}
			foreach($eventos as $evento){
				if($evento->data==$ano."-".$mes."-".$dia){?>
				<a id="link-<?php echo $dia?>" class="link-calendario" data-toggle="modal" href="#modal-form" onmouseover="ver_popup(<?php echo $dia ?>);" onmouseout="esconde_popup(<?php echo $dia ?>)" onclick="ver_eventos(<?php echo $ano?>,<?php echo $mes?>,<?php echo $dia?>);return false;">
				<div id="div-<?php echo $dia?>" class="popup">
																	
									</div>
				<?php 
				$link=1;
				}
			}
			foreach($eventos_agenda as $evento_agenda){
				if($evento_agenda->data==$ano."-".$mes."-".$dia && $link==0){?>
							<a id="link-<?php echo $dia?>" class="link-calendario" data-toggle="modal" href="#modal-form" onmouseover="ver_popup(<?php echo $dia ?>);" onmouseout="esconde_popup(<?php echo $dia ?>)" onclick="ver_eventos(<?php echo $ano?>,<?php echo $mes?>,<?php echo $dia?>);return false;">
							<div id="div-<?php echo $dia?>" class="popup">
																	
																	</div>
							<?php 
							}
						}
				if($i>0){
				?>
								<div class="calendario_dia">
									<?php 
									}else{
									?>
									<div class="calendario_vazio">
									<?php
									}
									$evento_mark=0;
									if($i>0){?>
									<p><?php echo $i?></p>
									<?php }?>
									<?php 
									foreach($eventos as $evento){
										if($evento->data==$ano."-".$mes."-".$dia && $evento_mark==0){
											echo "<p>Eventos nesse dia</p>";
											?>
											<script>
												$('#div-<?php echo $dia?>').append('<p><?php echo $evento->titulo?><p>');
											</script>
											<?php 
											$evento_mark++;
										}
									}
									foreach($eventos_agenda as $evento_agenda){
										if($evento_agenda->data==$ano."-".$mes."-".$dia){
											if($evento_mark==0){
												echo "<p>Eventos nesse dia</p>";
											}
											?>
											<script>
												$('#div-<?php echo $dia?>').append('<p><?php echo $evento_agenda->titulo?><p>');
											</script>
											<?php 
										}
									}?>
								</div>
								<?php 
								$link=0;
								foreach($eventos as $evento){
									if($evento->data==$ano."-".$mes."-".$dia){?>
									</a>
									
									<?php 
									$link=1;
									}
								}
								foreach($eventos_agenda as $evento_agenda){
									if($evento_agenda->data==$ano."-".$mes."-".$dia && $link==0){?>
																	</a>
																	
																	<?php 
																	}
																}
									?>
							<?php }	
	}
		
}	
