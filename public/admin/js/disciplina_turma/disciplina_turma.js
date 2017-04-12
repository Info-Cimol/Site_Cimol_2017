var i=1;
	
	
	var x=0;
	

	
	function ordenar(num){
		switch(num){
			case 1:
				return 'Primeiro';
				break;
			case 2:
				return 'Segundo';
				break;
			case 3:
				return 'Terceiro';
				break;
			case 4:
				return 'Quarto';
				break;
			case 5:
				return 'Quinto';
				break;
			case 6:
				return 'Sexto';
				break;
			default:
				return 'Nenhum';
		}
	}

	function form_disciplina(turma, disciplina, professor){
		
		
    	form="<form action='"+base_url+"admin/disciplina_turma/salvar' method='post' enctype='multipart/form-data'>"+
    			"<div class='padded'>"+
    			"<div class='control-group'>"+
        		"<label style='font-size:18px'><strong>"+turma.nome+" - "+turma.titulo_curso+"</strong></label>"+
       			 	"<input type='hidden' name='disciplina[turma_id]' value='"+turma.id+"'/>"+
    			"</div>"+
    			"<div class='control-group'>"+
        		"<label class='control-label'>Discíplina</label>"+
        		"<div class='controls'>"+
            		"<select name='disciplina[disciplina_id]' id='disciplinas'>"+
                		"<option value='"+disciplina.id+"'> "+disciplina.titulo+"  </option>"+
                		//disciplinas+
                		"</select>"+
            		"</div>"+
    			"</div>"+
    			"<div class='control-group'>"+
        		"<label class='control-label'>Professor</label>"+
        		"<div class='controls'>"+
            	"<select name='disciplina[professor_id]' id='professores' >"+
            	"<option value='"+professor.id+"'> "+professor.nome+"  </option>"+
            		
            	"</select>"+
            
        		"</div>"+
    			"</div>"+
	            "<div class='form-actions'>"+
	                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar'>"+
	            "</div>"+
	           
	           
	        "</form>";
    	
    		return form;
    	
		
	}
	
	function nova_disciplina_turma(turma_id){ 
		$('#modal-body').html('');
		professor={id:'',nome:''};
		
		disciplina={id:'',titulo:'',carga_horaria:'',professor_id:'',professor_nome:''};
		console.log(base_url+"admin/turma/buscar_turma_json/"+turma_id);
		$.ajax({
	        url: base_url+"admin/turma/buscar_turma_json/"+turma_id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        	//console.log(data);
	        	turma=data[0];
	        	console.log(turma);
	        	$('#modal-body').append(form_disciplina(turma,disciplina,professor));
	        	
	        	console.log(turma);
	    		console.log(base_url+"admin/disciplina_turma/listar_disciplinas_curso_json/"+turma.curso_id+"/"+turma.periodo);
	    		
	    		$.ajax({
	    	        url: base_url+"admin/disciplina_turma/listar_disciplinas_curso_json/"+turma.curso_id+"/"+turma.periodo,
	    	        dataType: 'json',
	    	        type: "post",
	    	        success: function(data){
	    	        	console.log(data);
	    	        	$.each(data,function(index, element){
	    		 			
	    	 				$('#disciplinas').append(
	    	 						"<option value="+element.id+">"+element.titulo+"</option>"
	    	 				)
	    	 			});
	    	        }
	    		});
	        }
		});
		
		$.ajax({
	        url: base_url+"admin/professor/listar_json",
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        	
	        	$.each(data,function(index, element){
		 			console.log(element);
	 				$('#professores').append(
	 						"<option value="+element.id+">"+element.nome+"</option>"
	 				)
	 			});
	        }
		});
	}
