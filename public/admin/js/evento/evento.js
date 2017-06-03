	
	function form_evento(evento){
			form="<form action='"+base_url+"admin/evento/salvar_evento' method='post' enctype='multipart/form-data' >"+
					"<div class='padded'>"+
						"<input type='hidden' name='evento[id]' value='"+evento.id+"' />"+
                        "<div class='control-group'>"+
                            "<label class='control-label'>Título:</label>"+
                            "<div class='controls'>"+
                                "<input type='text' name='evento[titulo]' value='"+evento.titulo+"' required/>"+
                            "</div>"+
                        "</div>"+
                        "<div class='control-group'>"+
                            "<label class='control-label'>Descrição:</label>"+
                            "<div class='controls'>"+
                            "<div class='box closable-chat-box'>"+
                                            "<div class='chat-message-box'>"+
                                				"<textarea name='evento[descricao]' class='mceEditor' rows='5'>"+evento.descricao+"</textarea>"+
                                			"</div>"+	
                            "</div>"+
                            "</div>"+
                        "</div>"+
                        "<div class='control-group'>"+
                            "<label class='control-label'>Resumo:</label>"+
                            "<div class='controls'>"+
                            	"<div class='box closable-chat-box'>"+
                                    "<div class='chat-message-box'>"+
                                		"<textarea name='evento[resumo]' rows='5' maxlength='140'>"+evento.resumo+"</textarea>"+
                                	"</div>"+
                                "</div>"+	
                            "</div>"+
                        "</div>"+
                        
	                    "<div class='control-group'>"+
						                	"<label class='control-label'>Imagem:</label>";
							
		                    form+="<div id='file'><input type='file' name='evento[imagem]' ></div>";
		                    if(evento.id!=''){
								form+="<img src='"+base_url+evento.url_imagem+evento.nome_imagem+"' style='width:100px' /><br/>"+
								"<input type='hidden' name='evento[imagem_id]' value='"+evento.imagem_id +"' />"+
			                	"<input type='checkbox' name='edit' onclick='exibir_input_file()' />Substituir imagem <br/>";
							}	
		                form+="</div>"+
                        "<div class='form-actions'>"+
	                    	"<button type='submit' class='btn btn-blue'>Salvar</button>"+
	                    "</div>"+
				"</form>";
			
			
				return form;
			 		
		}
		
		function exibir_input_file(){
			
			$("#file").show();
		}
		
		
	
		function editar_evento(id){
			$('#modal-body').html('');
			//console.log(base_url+"admin/curso/buscar_curso/"+id);
			$.ajax({
		        url: base_url+"admin/evento/buscar_evento/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data);
		        	evento=data[0]
		        	$('#modal-body').html('');
		        	$('#modal-body').append(form_evento(evento));
		        	callTinymce();
		        	if(evento.id!=''){
						$("#file").hide();
		        	}
		        	/*$.each(data,function(index, element){
			 			
		        		$.each(data,function(index, element){
            				if(index>0){
				    	 		$('#cursos').append(
				    	 			"<input type='checkbox' name='cursos[]' value='"+element.id+"'>"+element.titulo+"<br/>"
            				)
            				}
			        	 	});
		        		
	        			$.ajax({
	        		        url: base_url+"admin/evento/buscar_curso_evento/"+id,
	        		        dataType: 'json',
	        		        type: "post",
	        		        success: function(data){
	        		        	$.each(data,function(index, element){
	        		        		$(":checkbox[value="+element.curso_id+"]").prop("checked","true");
	        		        	})
	        		        }
	        			})
						
		        	});*/
		        	
		        	
		        }
			})
		}
		
		function novo_evento(){ 
			$('#modal-body').html('');
			evento={id:'', titulo:'',descricao:'', resumo:''};
			
			$('#modal-body').append(form_evento(evento));
			callTinymce();
			
			
		}
		
		
		
		function form_edicao_evento(edicao_evento){
			form="<form action='"+base_url+"admin/evento/salvar_edicao' method='post' enctype='multipart/form-data' >"+
					"<div class='padded'>"+
						"<input type='hidden' name='edicao_evento[evento_id]' value='"+edicao_evento.evento_id+"' />"+
						"<input type='hidden' name='edicao_evento[id]' value='"+edicao_evento.id+"' />"+
                        "<div class='control-group'>"+
                            "<label class='control-label'>Título:</label>"+
                            "<div class='controls'>"+
                                "<input type='text' name='edicao_evento[titulo]' value='"+edicao_evento.titulo+"' required/>"+
                            "</div>"+
                        "</div>"+
                        
                        "<div class='control-group'>"+
                            "<label class='control-label'>Slogan:</label>"+
                            "<div class='controls'>"+
                            	"<input type='text' name='edicao_evento[slogan]' value='"+edicao_evento.slogan+"' />"+
                            	
                            "</div>"+
                        "</div>"+
                        
                        "<div class='control-group'>"+
                            "<label class='control-label'>Edição:</label>"+
                            "<div class='controls'>"+
                            	"<input type='text' name='edicao_evento[edicao]' class='input-small' value='"+edicao_evento.edicao+"' required/>"+
                        	"</div>"+
                        "</div>"+
                        
                        "<div class='control-group'>"+
                        	"<label class='control-label'>Data ínicio:</label>"+
                        	"<div id='data' class='controls'>"+
                            	"<input type='date' class='data' name='edicao_evento[data_inicial]' value='"+edicao_evento.data_inicial+"' required>"+
                            "</div>"+
                        "</div>"+
                        "<div class='control-group'>"+
	                    	"<label class='control-label'>Data final:</label>"+
	                    	"<div id='data' class='controls'>"+
	                        	"<input type='date' class='data' name='edicao_evento[data_final]' value='"+edicao_evento.data_final+"'required>"+
	                        "</div>"+
	                    "</div>"+
                        
	                    "<div class='control-group'>"+
		                	"<label class='control-label'>Imagem:</label>";
						
		                    form+="<div id='file'><input type='file' name='edicao_evento[imagem]' ></div>";
		                    if(edicao_evento.id!=''){
								form+="<img src='"+base_url+edicao_evento.url_imagem+edicao_evento.nome_imagem+"' style='width:100px' /><br/>"+
								"<input type='hidden' name='edicao_evento[imagem_id]' value='"+edicao_evento.imagem_id +"' />"+
			                	
								"<input type='checkbox' name='edit' onclick='exibir_input_file()' />Substituir imagem <br/>";
							}	
		               form+="</div>"+
                        "<div class='form-actions'>"+
	                    	"<button type='submit' class='btn btn-blue'>Salvar Mudanças</button>"+
	                    "</div>"+
				"</form>";
			
			
				return form;
			 		
		}
		
		
		
		function nova_edicao_evento(evento_id){ 
			$('#modal-body').html('');
			edicao_evento={id:'',evento_id:evento_id, titulo:'',edicao:'', slogan:'',data_final:'',data_inicial:''};
			
			$('#modal-body').append(form_edicao_evento(edicao_evento));
			callTinymce();
			
			
		}
		
		
		function editar_edicao_evento(evento_id,id){
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/evento/buscar_edicoes/"+evento_id+"/"+id+"/",
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data);
		        	edicao_evento=data[0]
		        	$('#modal-body').html('');
		        	$('#modal-body').append(form_edicao_evento(edicao_evento));
		        	callTinymce();
		        	if(edicao_evento.id!=''){
						$("#file").hide();
		        	}
		        	
		        }
			})
		}
		
		function listar_imagens_edicao(evento_id,edicao_evento_id){
			
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/evento/listar_imagens_edicao/"+edicao_evento_id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	$('#modal-body').html('');
		        	$('#modal-body').append(
		        			"<div id='content' class='padded'>"+
		        			"</div>");
		        			$.each(data,function(index, element){
		        				console.log(element);
		        				console.log(base_url+element.url_imagem+element.nome);
		        	        	$('#content').append( 			
		        				"<div class='div-imagem-modal controls'>"+
		    					"<img src='"+base_url+element.url_imagem+element.nome+"'>"+
		    					"<br/>"+
		    					"<a class='btn btn-default botao-excluir' onclick='excluir_imagem_edicao("+element.id+","+edicao_evento_id+","+evento_id+");'><i class='icon-trash'></i> </a>"+
		    					"</div>"
		    					);
		        			})
		        			$('#content').after("<div id='form-modal-imagem'><form method='POST' action='"+base_url+"admin/evento/salvar_imagens_edicao/"+edicao_evento_id+"/' enctype='multipart/form-data'>"+
		        					"<input type='hidden' name='edicao_evento_id' value='"+edicao_evento_id+"'/>"+
		        					"<input type='hidden' name='evento_id' value='"+evento_id+"'/>"+
		        					"<input type='file' name='imagens[]' accept='image/*' multiple />"+
	    		    				"<br/>"+
	    		    				"<button type='submit' class='btn btn-blue'>Salvar Imagens</button>"+
	    		    				"</form></div>"		
	    	        			);
		        	}
			})
		}
		
		function excluir_imagem_edicao(imagem_id, edicao_id, evento_id){
			console.log(imagem_id+"-"+edicao_id+"-"+evento_id);
			$.ajax({
		        url: base_url+"admin/evento/excluir_imagem_edicao/"+imagem_id+"/"+edicao_id+"/"+evento_id,
		        type: "post",
		        success:function () {
		        	listar_imagens_edicao(evento_id, edicao_id);
		        }
			});
		}
		
		
		/**
		 * Painel Evento
		 */
		
		function form_painel_edicao_evento(painel_edicao_evento){
			form="<form action='"+base_url+"admin/evento/salvar_painel_edicao' method='post' enctype='multipart/form-data' >"+
					"<div class='padded'>"+
						"<input type='hidden' name='painel_edicao_evento[evento_id]' value='"+painel_edicao_evento.evento_id+"' />"+
						"<input type='hidden' name='painel_edicao_evento[edicao_id]' value='"+painel_edicao_evento.edicao_id+"' />"+
						"<input type='hidden' name='painel_edicao_evento[id]' value='"+painel_edicao_evento.id+"' />"+
                        
						"<div class='control-group'>"+
                            "<label class='control-label'>Título:</label>"+
                            "<div class='controls'>"+
                                "<input type='text' name='painel_edicao_evento[titulo]' value='"+painel_edicao_evento.titulo+"' required/>"+
                            "</div>"+
                        "</div>"+
                        
                        "<div class='control-group'>"+
                        "<label class='control-label'>Descrição:</label>"+
                        "<div class='controls'>"+
                        	"<div class='box closable-chat-box'>"+
                                "<div class='chat-message-box'>"+
                            		"<textarea name='painel_edicao_evento[descricao]' rows='5' maxlength='140' required>"+painel_edicao_evento.descricao+"</textarea>"+
                            	"</div>"+
                            "</div>"+	
                        "</div>"+
                    "</div>"+
                                                
                        "<div class='control-group'>"+
                        	"<label class='control-label'>Data:</label>"+
                        	"<div id='data' class='controls'>"+
                            	"<input type='date' class='data' name='painel_edicao_evento[data]' value='"+painel_edicao_evento.data+"' required>"+
                            "</div>"+
                        "</div>"+
                        "<div class='control-group'>"+
	                    	"<label class='control-label'>Horário:</label>"+
	                    	"<div id='data' class='controls'>"+
	                        	"<input type='time' class='time' name='painel_edicao_evento[hora]' value='"+painel_edicao_evento.hora+"'required>"+
	                        "</div>"+
	                    "</div>"+
                        
	                    "<div class='control-group'>"+
		                	"<label class='control-label'>Imagem:</label>";
						
		                    form+="<div id='file'><input type='file' name='painel_edicao_evento[imagem]' ></div>";
		                    if(painel_edicao_evento.id!=''){
								form+="<img src='"+base_url+painel_edicao_evento.url_imagem+painel_edicao_evento.nome_imagem+"' style='width:100px' /><br/>"+
								"<input type='hidden' name='painel_edicao_evento[imagem_id]' value='"+painel_edicao_evento.imagem_id +"' />"+
			                	
								"<input type='checkbox' name='edit' onclick='exibir_input_file()' />Substituir imagem <br/>";
							}	
		               form+="</div>"+
                        "<div class='form-actions'>"+
	                    	"<button type='submit' class='btn btn-blue'>Salvar Mudanças</button>"+
	                    "</div>"+
				"</form>";
			
			
				return form;
			 		
		}
		
		
		
		function novo_painel_edicao_evento(evento_id,edicao_id){ 
			$('#modal-body').html('');
			painel_edicao_evento={id:'',evento_id:evento_id,edicao_id:edicao_id,titulo:'',imagem:'', datal:'',horario:''};
			
			$('#modal-body').append(form_painel_edicao_evento(painel_edicao_evento));
			callTinymce();
			
			
		}
		
		
		function editar_painel_edicao_evento(evento_id,edicao_id,painel_id){
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/evento/buscar_painel_edicao/"+evento_id+"/"+edicao_id+"/"+painel_id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data);
		        	painel_edicao_evento=data[0]
		        	$('#modal-body').html('');
		        	$('#modal-body').append(form_painel_edicao_evento(painel_edicao_evento));
		        	callTinymce();
		        	if(painel_edicao_evento.id!=''){
						$("#file").hide();
		        	}
		        	
		        }
			})
		}
		
		
		
		
