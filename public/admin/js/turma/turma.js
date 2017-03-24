	var curso_id=null;
	function form_turma(turma){
			form="<style>" +
					".control-group img{" +
					"width:150px;"+
					"</style>"+
					"<form action='"+base_url+"admin/turma/salvar' method='post' enctype='multipart/form-data'>"+
				    "<input type='hidden' name='turma[id]' value='"+turma.id+"' />"+
                    
					"<div class='padded'>"+
        				"<div class='control-group'>"+
		                    "<label class='control-label'>Nome:</label>"+
		                    "<div class='controls'>"+
		                        "<input type='text' name='turma[nome]' value='"+turma.nome+"' maxlength='60' required/>"+
		                    "</div>"+
		                "</div>"+
		                
		                "<div class='control-group'>"+
	                    "<label class='control-label'>Curso:</label>"+
	                    "<div class='controls'>"+
	                    "<select name='turma[segmento_curso_curso_id]' id='cursos' onchange='add_segmentos_curso()' >"+
	                    "<option value='"+turma.curso.id+"'>"+turma.curso.titulo+"</option>";
	    	            /*for(i=0;i<turma.cursos.length;i++){
	    					form +="<option value='"+turma.cursos[i].id+"'>"+turma.cursos[i].titulo+"</option>";
	    	            }*/
	    				form +="</select>"+
	    				"<select name='turma[segmento_curso_segmento_id]' id='segmentos' onchange='add_periodos_curso()'>"+
	    	            "<option value='"+turma.segmento.id+"'>"+turma.segmento.nome+"</option>";
	    	            /*for(i=0;i<data.segmentos_cursos.length;i++){
	    					form +="<option value='"+turma.segmentos_cursos[i].id+"'>"+turma.segmentos_cursos[i].descricao+"</option>";
	    	            }*/
	    				form +="</select>"+
	                    "</div>"+
	                "</div>"+
	                "<div class='control-group'>"+
                    "<label class='control-label'>Ano/Semestre:</label>"+
                    "<div class='controls'>"+
                        "<input class='span1' type='text' name='turma[ano]' value='"+turma.ano+"' required/>"+
                        "<select name='turma[periodo]' id='periodos'>"+
                        	/*"<option value='"+turma.semestre+"'>  </option>"+
                        	"<option value='1'>Primeiro Semestre</option>"+
                        	"<option value='2'>Segundo Semestre</option>"+*/
                        "</select>"+
                    "</div>"+
                "</div>"+    
		                
		                
		            "<div class='form-actions'>"+
		                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar'>"+
		            "</div>"+
		           
		           
		        "</form>";
					
				
			
				return form;
			 		
		}	
		
	
		function editar_turma(id){
			$('#modal-body').html('');
			//console.log(base_url+"admin/curso/buscar_curso/"+id);
			var segmento_curso;
			$.ajax({
		        url: base_url+"admin/curso/buscar_curso/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	//console.log(data);
		        	curso=data[0]
		        	$('#modal-body').html('');
		        	$('#modal-body').append(form_curso(curso));
		        	$.each(data,function(index, element){
			 			
		 				if(index>0){
		 						$('#coordenador').append(
		 								"<option value="+element.id+">"+element.nome+"</option>"
		 						)
		 				}
				
		        	});
		        	$("div.select select").val(curso.professor_id);
		        	
		        	
		        	
		        }
			})
			
			$.ajax({
				        url: base_url+"admin/curso/listar_segmentos_json/",
				        dataType: 'json',
				        type: "post",
				        success: function(segmentos){
				        	//console.log(segmentos);
				        	$.each(segmentos,function(index, segmento){
					 			
				 				$('#segmento').append(
				 						"<option value="+segmento.id+">"+segmento.nome+"</option>"
				 				)
				 			});
				        }
					})
		}
		
		
		function nova_turma(){ 
			$('#modal-body').html('');
			segmento={id:'',nome:''};
			curso={id:'',titulo:''};
			turma={id:'', nome:'',ano:'', semestre:'',curso:curso,segmento:segmento};
			$('#modal-body').append(form_turma(turma));
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
		        	console.log(info.num_periodos);
		        	for(i=1;i<=info.num_periodos;i++){
		        		console.log(i);
		        		if(i==1){
			        			$('#periodos').append(
				 						"<option value="+i+"> Primeiro "+periodo+"</option>");
				 		}else if(i==2){
				 			$('#periodos').append(
			 						"<option value="+i+"> Segundo "+periodo+"</option>");
				 		}else if(i==3){
				 			$('#periodos').append(
			 						"<option value="+i+"> Terceiro "+periodo+"</option>");
				 		}else if(i==4){
				 			$('#periodos').append(
			 						"<option value="+i+"> Quarto "+periodo+"</option>");
				 		}else if(i==5){
				 			$('#periodos').append(
			 						"<option value="+i+"> Qinto "+periodo+"</option>");
				 		}else if(i==6){
				 			$('#periodos').append(
			 						"<option value="+i+"> Sexto "+periodo+"</option>");
				 		}else if(i==7){
				 			$('#periodos').append(
			 						"<option value="+i+"> Sétimo "+periodo+"</option>");
				 		}
		        	}
		        	/*$.each(segmentos,function(index, segmento){
			 			console.log(segmento);
		 				$('#segmento').append(
		 						"<option value="+segmento.id+">"+segmento.nome+"</option>"
		 				)
		 			});*/
		        }
			})
		}
		
		
		
		
