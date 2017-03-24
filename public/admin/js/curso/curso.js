var periodo;

	
function form_curso(data){
			form="<style>" +
					".control-group img{" +
					"width:150px;" +
					"}" +
					".num_periodos{" +
					"margin-left:50px;" +
					"}"+
					"</style>"+
					"<form action='"+base_url+"admin/curso/editar_imagem/"+curso.id+"' method='post' enctype='multipart/form-data'>"+
					"<div class='padded'>" +
					"<input type='hidden' name='curso[id]' value='"+curso.id+"' />"+
	                "<div class='control-group'>"+
	                    "<label class='control-label'>Título:</label>"+
	                    "<div class='controls'>"+
	                        "<input type='text' name='curso[titulo]' value='"+curso.titulo+"' maxlength='60' required/>"+
	                    "</div>"+
	                "</div>"+
	                "<div class='control-group'>"+
	                    "<label class='control-label'>Descrição:</label>"+
	                    "<div class='controls'>"+
	                    	"<div class='box closable-chat-box'>"+
	                                    "<div class='chat-message-box'>"+
	                        				"<textarea name='curso[descricao]' class='mceEditor' rows='5' required>"+curso.descricao+"</textarea>"+
	                        			"</div>"+	
	                        	"</div>"+
	                    "</div>"+
	                "</div>"+
	                " <hr/>"+
	                "<div class='control-group select'>"+
	                	"<label class='control-label'>Coordenador:</label>"+
	                	"<select id='coordenador' name='coordenador_curso'>"+
	                	"<option value='#'>Selecione um professor</option>"+
	                	"</select>"+
	                "</div>"+
	                "<hr/>" +
	                "<div class='control-group'>";
					if(curso.id!=''){
						form+="<img src='"+base_url+"/"+curso.logo+"' />";
					}
					form+="<label class='control-label'>Trocar Logo:</label>"+
		                    "<input type='file' name='logo' >"+
		            "</div>"+
		                
		           "<hr/>" +
		           "<div class='control-group' id='segmento'>"+
	                	"<label class='control-label'>Segmentos:</label>";
	               // console.log(curso);	
	                	
	               form+= "</div>"+
	                " <hr/>"+   
		            "<div class='form-actions'>" +
		            
		                	                
		                "<button type='submit' class='btn btn-blue'>Adicionar Curso</button>"+
		            "</div>"+
		            "<input type='hidden' name='old-logo' value='"+curso.logo+"'>"+
		            "<input type='hidden' name='old-coordenador' value='"+curso.professor_id+"'>"+
		        "</form>";
					
				
			
				return form;
			 		
		}	
		
	
		function editar_curso(id){
			$('#modal-body').html('');
			//console.log(base_url+"admin/curso/buscar_curso/"+id);
			var segmento_curso;
			//console.log(base_url+"admin/curso/buscar_curso/"+id);
			$.ajax({
		        url: base_url+"admin/curso/buscar_curso_editar/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	//console.log(data);
		        	curso=data.curso;
		        	//console.log(curso.segmentos);
		        	$('#modal-body').html('');
		        	$('#modal-body').append(form_curso(curso));
		        	$.each(data.professores,function(index, element){
			 			$('#coordenador').append(
		 								"<option value="+element.id+">"+element.nome+"</option>"
		 						)
		 			});
		        	$("div.select select").val(curso.professor_id);
		        	
		        	$.each(data.segmentos,function(index, segmento){
		        		var y=0;
		        		var num_modulos;
		        		$.each(curso.segmentos, function(index,s){
		        			if(segmento.id==s.id){
		        				num_modulos=s.num_periodos;
		        				y++;
		        			}
		        		});
		        		if(segmento.periodo=='anual')
	        				periodo="Anos";
	        			else
	        				periodo="Semestres";
		        		if(y>0){
		        			
		        			$('#segmento').append(
			 						"<div id='segmento"+segmento.id+"' ><input type='checkbox' name='curso[segmentos][segmento_id][]' onclick='add_num_periodos(segmento"+segmento.id+")' value="+segmento.id+" checked />"+segmento.nome+
			 						" <input type='number' class='num_periodos' name=curso[segmentos][num_periodos][]' value="+num_modulos+" />"+periodo+"</div><br/>"
			 				);
		        		}else{
			        		$('#segmento').append(
			 						"<div id='segmento"+segmento.id+"' ><input type='checkbox' name='curso[segmento_id][]' onclick='add_num_periodos(segmento"+segmento.id+")' value="+segmento.id+" />"+segmento.nome+
			 						" </div><br/>"
			 				);
		        		}
		 			});
		        	
		        	
		        	
		        	
		        	
		        }
			})
			
			
		}
		
		
		function novo_curso(){ 
			$('#modal-body').html('');
			curso={id:'', titulo:'',descricao:'', logo:'',professor_id:''};
			
			$('#modal-body').append(form_curso(curso));
			$.ajax({
		        url: base_url+"admin/curso/listar_professores/",
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	
		        	$.each(data,function(index, element){
			 			
		 				$('#coordenador').append(
		 						"<option value="+element.id+">"+element.nome+"</option>"
		 				)
		 			});
		        }
			})
			
			$.ajax({
		        url: base_url+"admin/curso/listar_segmentos_json/",
		        dataType: 'json',
		        type: "post",
		        success: function(segmentos){
		        	//console.log(segmentos);
		        	$.each(segmentos,function(index, segmento){
		        		if(segmento.periodo=='anual')
	        				periodo="Anos:";
	        			else
	        				periodo="Semestres";
		        		
		 				$('#segmento').append(
		 						"<div id='segmento"+segmento.id+"' ><input type='checkbox' name='curso[segmento_id][]' onclick='add_num_periodos(segmento"+segmento.id+")' id='seg' value="+segmento.id+" />"+segmento.nome+
		 						" </div><br/>"
		 				);
		 			});
		        }

			})
			
			
			
		}
		
		
		function add_num_periodos(id){
			$(id).append(" <input type='number' name=curso[num_modulos][]' class='num_periodos'/> "+periodo+" ");
			
		}
		
		$(".segmento_curso").click(function(){
			console.log($(this));
			console.log($(this).closest('[data-id]'));
			
		});
		
		
		
		function listaProfessores(){
			
		}
		
		function buscaCordenador(){
			
		}
		
		
		
		
