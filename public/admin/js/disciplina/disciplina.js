function form_disciplina(disciplina){
			form="<style>" +
					".control-group img{" +
					"width:150px;"+
					"</style>"+
					"<form action='"+base_url+"admin/disciplina/salvar' method='post' enctype='multipart/form-data'>"+
				    "<input type='hidden' name='disciplina[id]' value='"+disciplina.id+"' />"+
                    
					"<div class='padded'>"+
        				"<div class='control-group'>"+
		                    "<label class='control-label'>Titulo:</label>"+
		                    "<div class='controls'>"+
		                        "<input type='text' name='disciplina[titulo]' value='"+disciplina.titulo+"' maxlength='60' required/>"+
		                    "</div>"+
		                "</div>"+
		                
		                "<div class='control-group'>"+
	                    "<label class='control-label'>Curso:</label>"+
	                    "<div class='controls'>"+
	                    "<select name='disciplina[segmento_curso_curso_id]' id='cursos' onchange='add_segmentos_curso()' >"+
	                    "<option value='"+disciplina.segmento_curso_curso_id+"'>"+disciplina.titulo_curso+"</option>";
	    	            
	    				form +="</select>"+
	    				"<select name='disciplina[segmento_curso_segmento_id]' id='segmentos' onchange='add_periodos_curso()'>"+
	    	            "<option value='"+disciplina.segmento_curso_segmento_id+"'>"+disciplina.nome_segmento+"</option>";
	    	            
	    				form +="</select>"+
	                    "</div>"+
	                "</div>"+
	                "<div class='control-group'>"+
                    "<label class='control-label'>Perido:</label>"+
                    "<div class='controls'>"+
                       "<select name='disciplina[periodo]' id='periodos'>"+
                       
	    	             	
                        "</select>"+
                    "</div>"+
                    "</div>"+ 
                
                    "<div class='control-group'>"+
	                    "<label class='control-label'>Carga Horária:</label>"+
	                    "<div class='controls'>"+
	                       "<input type='number' name='disciplina[carga_horaria]' value='"+disciplina.carga_horaria+"' class='input-small'/>Horas"+
	                    "</div>"+
                    "</div>"+  
                    
                    "<div class='control-group'>"+
	                    "<label class='control-label'>Ementa:</label>"+
	                    "<div class='controls'>"+
	                       "<textarea name='disciplina[ementa]'>"+disciplina.ementa+"' </textarea>"+
	                    "</div>"+
                    "</div>"+  
		                
		            "<div class='form-actions'>"+
		                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar'>"+
		            "</div>"+
		           
		           
		        "</form>";
					
	    		
			
				return form;
			 		
		}	
		
	
		function editar_disciplina(id){
			$('#modal-body').html('');
			//console.log(base_url+"admin/curso/buscar_curso/"+id);
			var segmento_curso;
			$.ajax({
		        url: base_url+"admin/disciplina/buscar/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	//console.log(data);
		        	disciplina=data[0]
		        	$('#modal-body').html('');
		        	$('#modal-body').append(form_disciplina(disciplina));
		        	
		        	formatarPeriodo(disciplina.periodo,null);
		        }
		    });
			$.ajax({
		        url: base_url+"admin/curso/listar_cursos_json",
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	$.each(data,function(index, element){
			 			console.log(element);
		 				$('#cursos').append(
		 						"<option value="+element.id+">"+element.titulo+"</option>"
		 				)
		 			});
		        }
			})
		}
		
		
		function nova_disciplina(disciplina){ 
			$('#modal-body').html('');
			segmento={id:'',nome:''};
			curso={id:'',titulo:''};
			disciplina={id:'',titulo:'',ementa:'',carga_horaria:'',curso:curso,segmento:segmento,periodo:''};
			
			$('#modal-body').append(form_disciplina(disciplina));
			$.ajax({
		        url: base_url+"admin/curso/listar_cursos_json",
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	
		        	$.each(data,function(index, element){
			 			console.log(element);
		 				$('#cursos').append(
		 						"<option value="+element.id+">"+element.titulo+"</option>"
		 				)
		 			});
		        }
			})
		}
		
		
		function add_segmentos_curso(){
			curso_id=$("#cursos option:selected").val();
			console.log(base_url+"admin/curso/listar_segmentos_curso_json/"+curso_id);
			$.ajax({
		        url: base_url+"admin/curso/listar_segmentos_curso_json/"+curso_id,
		        dataType: 'json',
		        type: "post",
		        success: function(segmentos){
		        	console.log(segmentos);
		        	$.each(segmentos,function(index, segmento){
			 			console.log(segmento);
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
		        		console.log(i);
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
		
		
		
