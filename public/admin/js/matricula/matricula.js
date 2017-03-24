	var x=0;
	var curso_id=null;
	function form_matricula(matricula){
			$('#modal-body').html('');
					form="<style>"+
			    	".select{" +
		    		"float:left;" +
		    		"margin:20px;" +
		    		"width:310px;" +
		    	"}" +
		    	"select{" +
		    		"width:300px;" +
		    	"}" +
		    	
		    	"</style>"+
		    	"<span id='aviso'></span>";
			   		form +="<form action='"+base_url+"admin/matricula/salvar/' method='post' enctype='multipart/form-data'>"+
        			"<div class='padded'>"+
    				"<div class='control-group'>"+
	                    "<label class='control-label'>Matricula:</label>"+
	                    "<div class='controls'>"+
	                        "<input type='text' name='matricula[matricula]' value='"+matricula.matricula+"' id='matricula' onblur='verificarMatricula()' maxlength='40' required/>"+
	                        "<span id='aviso_matricula'></span>"+
	                        "</div>"+
	                "</div>";
			   		
			   		form+="<div class='control-group'>"+
	       			 		"<label style='font-size:18px'><strong> Aluno</strong></label>"+
	       			 		"<input type='text' name='aluno' id='aluno' onkeypress='buscarAlunos()' value='' size='60' maxlength='60'/>"+
		                   	
	       			 	"</div>";
			   		
			   		form+="<div class='control-group'>"+
   			 		"<select name='matricula[aluno_id]' id='alunos' size='20' multiple='multiple'>"+
   			 			
   			 		"</select>"+
   			 		"</div>";
			   		
			   		form+="<div class='control-group'>"+
       			 		"<label style='font-size:18px'><strong> Curso</strong></label>"+
       			 		"<select name='matricula[segmento_curso_curso_id]' id='cursos' onchange='add_segmentos_curso()' >"+
	                    "<option value=''> </option>";
	    	            
	    				form +="</select>"+
	    				
	    				"<select name='matricula[segmento_curso_segmento_id]' id='segmentos' onchange='add_periodos_curso(); verificarMatriculaAlunoCurso()' >"+
	    	            "<option value=''></option>";
	    	            
	    				form +="</select>"+
       			 		"</select>"+
       			 	"</div>"+
       			 "<div class='control-group'>"+
                 "<label class='control-label'>Perido:</label>"+
                 "<div class='controls'>"+
                    "<select name='matricula[periodo]' id='periodos'>"+
                    
	    	             	
                     "</select>"+
                 "</div>"+
                 "</div>";
			   		
			   		
				form+="<div class='form-actions'>"+
	                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar'>"+
	            "</div></form>";
				
		        $('#modal-body').append(form);

		}
		   

	
		function editar_matricula(matricula){
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/matricula/buscar/"+matricula,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data[0]);
		        	form_matricula(data[0]);
		            telefones='';
		          
		        }
			});
		}
		
		
		function nova_matricula(){ 
			$('#modal-body').html('');
			matricula={pessoa_id:'',nome:'',matricula:'',foto:''};
			
			form_matricula(matricula);
			
			$.ajax({
		        url: base_url+"admin/aluno/listar_json/",
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data);
		        	$.each(data.alunos,function(index, element){
    		 			
    	 				$('#alunos').append(
    	 						"<option value="+element.id+">"+element.nome+"</option>"
    	 				)
    	 			});
		        }
			});
			
			$.ajax({
		        url: base_url+"admin/curso/listar_cursos_json/",
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data);
		        	$.each(data,function(index, element){
    		 			
    	 				$('#cursos').append(
    	 						"<option value="+element.id+">"+element.id+" - "+element.titulo+"</option>"
    	 				)
    	 			});
		        }
			});
			
			
		}
		
		
		function adicionar_aluno_turma(turma_id){ 
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/turma/buscar_turma_json/"+turma_id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	
		        	turma=data[0];
		        	
		        	$('#modal-body').append(form_aluno(turma));
		        	
		    		console.log(base_url+"admin/curso/listar_alunos_curso_json/"+turma.curso_id);
		    		
		    		$.ajax({
		    	        url: base_url+"admin/curso/listar_alunos_curso_json/"+turma.curso_id+"/"+turma.periodo,
		    	        dataType: 'json',
		    	        type: "post",
		    	        success: function(data){
		    	        	console.log(data);
		    	        	$.each(data,function(index, element){
		    		 			
		    	 				$('#alunos_curso').append(
		    	 						"<option value="+element.id+">"+element.id+" - "+element.matricula+" - "+element.nome+"</option>"
		    	 				)
		    	 			});
		    	        }
		    		});
		        }
			});
			
			
		}
		function buscarAlunos(){
			//console.log($('#aluno').val());
			$.ajax({
		        url: base_url+"admin/aluno/pesquisar_por_nome_json/"+$('#aluno').val(),
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	$('#alunos').empty();
		        	$.each(data.alunos,function(index, element){
    		 			
    	 				$('#alunos').append(
    	 						"<option value="+element.id+">"+element.id+" - "+element.nome+"</option>"
    	 				)
    	 			});
		        }
			});
		}
		
		function verificarMatricula(){
			$.ajax({
		        url: base_url+"admin/matricula/verifica_existencia_matricula_json/"+$('#matricula').val(),
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	
		        	if(data==1){
		        		$('#aviso').html("Esta matrícula já existe!");
		        	}else{
		        		$('#aviso').html("");
		        	}
		        	
		        }
			});
		}
		
		function verificarMatriculaAlunoCurso(){
			
			console.log(base_url+"admin/matricula/verifica_matricula_aluno_curso_json/"+$('#alunos').val()+"/"+$('#cursos').val()+"/"+$('#segmentos').val());
			$.ajax({
		        url: base_url+"admin/matricula/verifica_matricula_aluno_curso_json/"+$('#alunos').val()+"/"+$('#cursos').val()+"/"+$('#segmentos').val(),
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	//console.log(data);
		        	if(data==1){
		        		$('#aviso').html("Aluno já está matriculado neste curso!");
		        	}else{
		        		$('#aviso').html("");
		        	}
		        	
		        }
			});
			
			
		}
		function add_segmentos_curso(){
			curso_id=$("#cursos option:selected").val();
			console.log(base_url+"admin/curso/listar_segmentos_curso_json/"+curso_id);
			$.ajax({
		        url: base_url+"admin/curso/listar_segmentos_curso_json/"+curso_id,
		        dataType: 'json',
		        type: "post",
		        success: function(segmentos){
		        	//console.log(segmentos);
		        	$.each(segmentos,function(index, segmento){
			 			//console.log(segmento);
		 				$('#segmentos').append(
		 						"<option value="+segmento.id+">"+segmento.nome+"</option>"
		 				)
		 			});
		        }
			})
		}
		
		function add_periodos_curso(){
			segmento_id=$("#segmentos option:selected").val();
			//console.log(base_url+"admin/curso/buscar_info_periodos_curso_json/"+curso_id+"/"+segmento_id);
			$.ajax({
		        url: base_url+"admin/curso/buscar_info_periodos_curso_json/"+curso_id+"/"+segmento_id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	//console.log(data[0]);
		        	info=data[0];
		        	periodo=null;
		        	if(info.periodo=='semestral'){
		        		periodo="semestre";
		        	}else if(info.periodo=='anual'){
		        		periodo="ano";
		        	}else{
		        		periodo=null;
		        	}
		        	//console.log(info.num_periodos);
		        	for(i=1;i<=info.num_periodos;i++){
		        		//console.log(i);
		        		formatarPeriodo(i,periodo);
		        	}
		        	
		        }
			})
		}
		
		function formatarPeriodo(ordem, periodo){
			if(ordem==1){
    			$('#periodos').append(
 						"<option value="+ordem+"> Primeiro "+periodo+"</option>");
	 		}else if(ordem==2){
	 			$('#periodos').append(
							"<option value="+ordem+"> Segundo "+periodo+"</option>");
	 		}else if(ordem==3){
	 			$('#periodos').append(
							"<option value="+ordem+"> Terceiro "+periodo+"</option>");
	 		}else if(ordem==4){
	 			$('#periodos').append(
							"<option value="+ordem+"> Quarto "+periodo+"</option>");
	 		}else if(ordem==5){
	 			$('#periodos').append(
							"<option value="+ordem+"> Qinto "+periodo+"</option>");
	 		}else if(ordem==6){
	 			$('#periodos').append(
							"<option value="+ordem+"> Sexto "+periodo+"</option>");
	 		}else if(ordem==7){
	 			$('#periodos').append(
							"<option value="+ordem+"> Sétimo "+periodo+"</option>");
	 		}
		}
		