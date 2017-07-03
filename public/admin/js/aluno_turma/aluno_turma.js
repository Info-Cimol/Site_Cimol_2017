
	
	function ordenar(num){
		switch(num){
			case "1":
				return 'Primeiro';
				break;
			case "2":
				return 'Segundo';
				break;
			case "3":
				return 'Terceiro';
				break;
			case "4":
				return 'Quarto';
				break;
			case "5":
				return 'Quinto';
				break;
			case "6":
				return 'Sexto';
				break;
			default:
				return 'Nenhum';
		}
	}

	function form_aluno(turma){
		
		console.log(turma);
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
    	"<form action='"+base_url+"admin/aluno_turma/salvar' method='post' enctype='multipart/form-data'>"+
    			"<div class='padded'>"+
    				"<div class='control-group'>"+
    					"<label style='font-size:18px'><strong>"+turma.nome+" - "+ordenar(turma.periodo)+" - "+turma.titulo_curso+"</strong></label>"+
       			 		"<input type='hidden' name='turma_id' value='"+turma.id+"'/>"+
       			 	"</div>"+
       			 	"<div class='select'>"+
	       			 	"<div class='control-group'>"+
	       			 		"<label style='font-size:18px'><strong> Alunos curso</strong></label>"+
	       			 		"<select name='alunos_curso' id='alunos_curso' size='20' multiple='multiple'>"+
	       			 			
	       			 		"</select>"+
	       			 	"</div>"+
       			 	"</div>"+
       			 	"<div style='float:left'>"+
       			 		"<br/>"+
       			 		"<br/>"+
       			 		"<br/>"+
       			 		"<a heref='' onclick='adiciona_aluno_curso()' ><i class='icon-arrow-right'></i> </a>" +
       			 		"<br/>"+
       			 		"<br/>"+
       			 		"<a heref='' onclick='remove_aluno_curso()'><i class='icon-arrow-left'></i></a>"+
       			 	"</div>"+
	       			 "<div class='select'>"+
		       			 "<div class='control-group'>"+
					 		"<label style='font-size:18px'><strong> Alunos da turma</strong></label>"+
					 		"<select name='alunos_turma[]'  id='alunos_turma_curso' size='20' multiple='multiple'>"+
					 			
					 		"</select>"+
					 	"</div>"+
					 "</div>"+
    			
	            "<div class='form-actions'>"+
	                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar' />"+
	            "</div>"+
	           
	           
	        "</form>";
    	
    		return form;
    	
		
	}
	
	function adicionar_aluno_turma(turma_id){ 
		$('#modal-body').html('');
		console.log(base_url+"admin/turma/buscar_turma_json/"+turma_id);
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
	    	 						"<option value="+element.id+" selected >"+element.id+" - "+element.matricula+" - "+element.nome+"</option>"
	    	 				)
	    	 			});
	    	        }
	    		});
	        }
		});
		
		
	}
	
	function adiciona_aluno_curso(){
		console.log($("#alunos_curso").val());
		console.log($('#alunos_curso option:selected').text());
		$('#alunos_turma_curso').append(
					"<option value="+$("#alunos_curso").val()+">"+$('#alunos_curso option:selected').text()+"</option>"
		)
		
		$("#alunos_curso option[value='"+$("#alunos_curso").val()+"']").remove();
		
	}
	
	function remove_aluno_curso(){
		
		$('#alunos_curso').append(
					"<option value="+$("#alunos_turma_curso").val()+">"+$('#alunos_turma_curso option:selected').text()+"</option>"
		)
		$("#alunos_turma_curso option[value='"+$("#alunos_turma_curso").val()+"']").remove();
	}
	 
	
