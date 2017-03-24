//var base_url="http://www2.cimol.g12.br/";
	function callTinymce(){
	tinymce.init({
		mode : "specific_textareas",
		editor_selector : "mceEditor",
                language : 'pt_BR',
                plugins: [
			    	          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			    	          'searchreplace wordcount visualblocks visualchars code fullscreen',
			    	          'insertdatetime media nonbreaking save table contextmenu directionality',
			    	          'emoticons template paste textcolor colorpicker textpattern imagetools'
			    	        ],
			    	toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
			    	toolbar2: 'print preview media | forecolor backcolor emoticons',
			    	        image_advtab: true,
			    	        templates: [
			    	          { title: 'Test template 1', content: 'Test 1' },
			    	          { title: 'Test template 2', content: 'Test 2' }
			    	        ]
		});
	}
	function ajaxModal(id){
	$('#modal-body').html('');
	$('#modal-body').html('');
                    $.ajax({
                            url: base_url+"admin/noticia/buscar_noticia/"+id,
                            dataType: 'json',
                            type: "post",
                            success: function(data){
                            			$('#modal-body').append("<h3 class='titulo-modal'>"+
                            					data[0].titulo+"</h3><div class='imagens-modal' id='imagens-aqui'></div><div class='conteudo'><p>"+
                            					data[0].conteudo+
                            					"</p></div>");
                            			$.each(data,function(index, element){
                            				if(index>0){
	        					    	 		$('#imagens-aqui').append(
	        					    	 		"<img src='"+base_url+element.url_imagem+element.nome+"'>");
                            				}
        					        	 	})
                            }
                    })
            }

	function ajaxModalEvento(id){
	$('#modal-body').html('');
	$('#modal-body').html('');
                    $.ajax({
                            url: base_url+"admin/evento/buscar_evento/"+id,
                            dataType: 'json',
                            type: "post",
                            success: function(data){
                            			$('#modal-body').append("<h3 class='titulo-modal'>"+
                            					data[0].titulo+"</h3><div class='imagens-modal' id='imagens-aqui'></div><div class='conteudo'><p>"+
                            					data[0].descricao+
                            				"</p></div>");
                            			$.each(data,function(index, element){
                            				if(index>0){
	        					    	 		$('#imagens-aqui').append(
	        					    	 		"<img src='"+base_url+element.url_imagem+element.nome+"'>");
                            				}
        					        	 	})
                            }
                    })
            }
	
	function editar_imagem(url, i){
		$('#modal-body-imagem').html('');
		$('#modal-body-imagem').append("<img id='imagem-"+i+"' src='"+base_url+url+"'></img>");
		$('#imagem-'+i).Jcrop({
			boxHeight:400,
			onSelect: cropImagem,
		    onChange: cropImagem,
		    allowSelect: false,
            keySupport: false,
            minSize: [200],
        	setSelect:   [ 100, 100, 50, 50 ],
        	aspectRatio: 4 / 3
        });
		function cropImagem(c){
			$('#x-'+i).val( c.x ),
        	$('#y-'+i).val( c.y ),
        	$('#width-'+i).val( c.w ),
        	$('#height-'+i).val( c.h )
		}
	}
	
	function editar_logo(url){
		$('#modal-body-imagem').html('');
		$('#modal-body-imagem').append("<img id='imagem' src='"+base_url+url+"'></img>");
		$('#imagem').Jcrop({
			boxHeight:400,
			onSelect: cropImagem,
		    onChange: cropImagem,
		    allowSelect: false,
            keySupport: false,
            minSize: [200],
        	setSelect:   [ 100, 100, 50, 50 ],
        	aspectRatio: 4 / 3
        });
		function cropImagem(c){
			$('#x').val( c.x ),
        	$('#y').val( c.y ),
        	$('#width').val( c.w ),
        	$('#height').val( c.h )
		}
	}


	function imagens_formal(){
		$('#modal-body').html('');
		$('.modal-header').html('');
		$('.modal-header').append("<p>Adicionar Imagens</p>");
		$('#modal-body').append("<div><form method='POST' action='"+base_url+"admin/imagem/editar_imagens' enctype='multipart/form-data'>"+
				"<input type='file' name='imagens[]' accept='image/*' multiple>"+
				"<br/>"+
				"<button type='submit' class='btn btn-blue'>Salvar Imagens</button>"+
				"</form></div>"
		);
	}
	
	function ver_link(id, value){
			$('#link-input-'+id).val(value);
			$('#link-'+id).css('display','block');
			$('#ver-link-'+id).text("Fechar link");
			$('#ver-link-'+id).attr("onclick","fechar_link("+id+",'"+value+"');return false;");
	}
	
	function fechar_link(id, value){
		$('#link-'+id).css('display','none');
		$('#ver-link-'+id).text("Ver link");
		$('#ver-link-'+id).attr("onclick","ver_link("+id+",'"+value+"');return false;");
	}
	
	function listar_imagens_evento(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/imagem/buscar_imagens_evento/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        	$('#modal-body').html('');
	        	$('#modal-body').append(
	        			"<div id='content' class='padded'>"+
	        			"</div>");
	        			$.each(data,function(index, element){
	        	        	$('#content').append( 			
	        				"<div class='div-imagem-modal controls'>"+
	    					"<img src='"+base_url+element.url_imagem+element.nome+"'>"+
	    					"<br/>"+
	    					"<a class='btn btn-default botao-excluir' onclick='excluir_imagem_evento("+element.id+","+id+");'><i class='icon-trash'></i> </a>"+
	    					"</div>"
	    					);
	        			})
	        			$('#content').after("<div id='form-modal-imagem'><form method='POST' action='"+base_url+"admin/imagem/editar_imagens/"+id+"/evento' enctype='multipart/form-data'>"+
    		    				"<input type='file' name='imagens[]' accept='image/*' multiple>"+
    		    				"<br/>"+
    		    				"<button type='submit' class='btn btn-blue'>Salvar Imagens</button>"+
    		    				"</form></div>"		
    	        			);
	        	}
		})
	}
	
	function listar_imagens(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/imagem/buscar_imagens/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        	$('#modal-body').html('');
	        	$('#modal-body').append(
	        			"<div id='content' class='padded'>"+
	        			"</div>");
	        			$.each(data,function(index, element){
	        	        	$('#content').append( 			
	        				"<div class='div-imagem-modal controls'>"+
	    					"<img src='"+base_url+element.url_imagem+element.nome+"'>"+
	    					"<br/>"+
	    					"<a class='btn btn-default botao-excluir' onclick='excluir_imagem_noticia("+element.id+","+id+");'><i class='icon-trash'></i> </a>"+
	    					"</div>"
	    					);
	        			})
	        			$('#content').after("<div id='form-modal-imagem'><form method='POST' action='"+base_url+"admin/imagem/editar_imagens/"+id+"/noticia' enctype='multipart/form-data'>"+
    		    				"<input type='file' name='imagens[]' accept='image/*' multiple>"+
    		    				"<br/>"+
    		    				"<button type='submit' class='btn btn-blue'>Salvar Imagens</button>"+
    		    				"</form></div>"		
    	        			);
	        	}
		})
	}
	
	function excluir_imagem_noticia(imagem_id,noticia_id){
		$.ajax({
	        url: base_url+"admin/noticia/excluir_imagem_noticia/"+imagem_id+"/"+noticia_id,
	        type: "post",
	        success:function () {
	        	listar_imagens(noticia_id);
	        }
		});
	}
	
	function excluir_imagem_evento(imagem_id,evento_id){
		$.ajax({
	        url: base_url+"admin/evento/excluir_imagem_evento/"+imagem_id+"/"+evento_id,
	        type: "post",
	        success:function () {
	        	listar_imagens_evento(evento_id);
	        }
		});
	}
	
	function editar_video(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/video/buscar_video/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        	$('#modal-body').html('');
	        	$('#modal-body').append('<form action="'+base_url+'admin/video/salvar_video/'+id+'" method="post">'+
    				'<div class="control-group">'+
		                '<label class="control-label">Título:</label>'+
		                '<div class="controls">'+
		                    '<input type="text" name="video[titulo]" maxlength="120" value="'+data[0].titulo+'" required/>'+
		                '</div>'+
		            '</div>'+
		            '<div class="control-group">'+
		            	'<label class="control-label">Descricao:</label>'+
		            	'<div class="controls">'+
		                    '<textarea name="video[descricao]" rows="5">'+data[0].descricao+'</textarea>'+
		                 '</div>'+
		             '</div>'+
		             '<div class="control-group">'+
		                '<label class="control-label">URL:</label>'+
		                '<div class="controls">'+
		                    '<input type="url" name="video[url]" maxlength="120" value="'+data[0].url+'" required/>'+
		                '</div>'+
		            '</div>'+
		        '<div class="form-actions">'+
		        	'<button type="submit" class="btn btn-blue">Adicionar Vídeo</button>'+
		        '</div>'+
		      '</form>');
	        }
		});
	}
	
	function editar_agenda(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/agenda/buscar_agenda/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        	$('#modal-body').html('');
    			$('#modal-body').append("<form action='"+base_url+"admin/agenda/salvar_agenda/"+id+"' method='post'>"+
    					'<div class="control-group">'+
			                '<label class="control-label">Data:</label>'+
			                '<div class="controls">'+
			                    '<input type="date" class="data" name="agenda[data]" maxlength="60" value="'+data[0].data+'" required/>'+
			                '</div>'+
			            '</div>'+
			            '<div class="control-group">'+
			                '<label class="control-label">Hora:</label>'+
			                '<div class="controls">'+
			                    '<input type="time" class="hora" name="agenda[hora]" maxlength="60" value="'+data[0].hora+'" required/>'+
			                '</div>'+
			            '</div>'+
			            '<div class="control-group">'+
			            	'<label class="control-label">Título:</label>'+
			            	'<div class="controls">'+
			            		'<input type="text" name="agenda[titulo]" value="'+data[0].titulo+'" />'+
			            	'</div>'+
			            '</div>'+
			            '<div class="control-group">'+
			            	'<label class="control-label">Evento:</label>'+
			            	'<div class="controls">'+
			                    '<textarea name="agenda[evento]" class="mceEditor" rows="5">'+data[0].evento+'</textarea>'+
			                 '</div>'+
			             '</div>'+
			        '<div class="form-actions">'+
			        	'<button type="submit" class="btn btn-blue">Adicionar Agenda</button>'+
			        '</div>'+
			      '</form>')           
	        }
		});
	}
	
	function editar_pagina(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/pagina/buscar_pagina/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        			$('#modal-body').html('');
	        			$('#modal-body').append("<form action='"+base_url+"admin/pagina/salvar_pagina/"+id+"' method='post'>"+
	        					"<div class='padded'>"+
			                        "<div class='control-group'>"+
			                            "<label class='control-label'>Título:</label>"+
			                            "<div class='controls'>"+
			                                "<input type='text' name='pagina[titulo]' value='"+data[0].titulo+"' required/>"+
			                            "</div>"+
			                        "</div>"+
			                        "<div class='control-group'>"+
			                            "<label class='control-label'>Conteúdo:</label>"+
			                            "<div class='controls'>"+
			                            "<div class='box closable-chat-box'>"+
			                                            "<div class='chat-message-box'>"+
			                                				"<textarea name='pagina[conteudo]' class='mceEditor' rows='5' required>"+data[0].conteudo+"</textarea>"+
			                                			"</div>"+	
			                            "</div>"+
			                            "</div>"+
			                        "</div>"+
			                        "<div class='form-actions'>"+
				                    	"<button type='submit' class='btn btn-blue'>Salvar Mudanças</button>"+
				                    "</div>"+
	        				"</form>");	
	        			callTinymce();
	        }
		})
	}
	
	function editar_curso(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/curso/buscar_curso/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        	$('#modal-body').html('');
	        	$('#modal-body').append("<form action='"+base_url+"admin/curso/editar_imagem/"+id+"' method='post' enctype='multipart/form-data'>"+
	        			"<div class='padded'>"+
			                "<div class='control-group'>"+
			                    "<label class='control-label'>Título:</label>"+
			                    "<div class='controls'>"+
			                        "<input type='text' name='curso[titulo]' value='"+data[0].titulo+"' maxlength='60' required/>"+
			                    "</div>"+
			                "</div>"+
			                "<div class='control-group'>"+
			                    "<label class='control-label'>Descrição:</label>"+
			                    "<div class='controls'>"+
			                    "<div class='box closable-chat-box'>"+
			                                    "<div class='chat-message-box'>"+
			                        				"<textarea name='curso[descricao]' class='mceEditor' rows='5' required>"+data[0].descricao+"</textarea>"+
			                        			"</div>"+	
			                    "</div>"+
			                    "</div>"+
			                "</div>"+
			                "<div class='control-group select'>"+
			                	"<label class='control-label'>Coordenador:</label>"+
			                	"<select id='coordenador' name='coordenador_curso'>"+
			                	"<option value='#'>Selecione um professor</option>"+
			                	"</select>"+
			                "</div>"+
			                "<div class='control-group'>"+
			                "<label class='control-label'>Trocar Logo:</label>"+
			                    "<input type='file' name='imagens' >"+
			                "</div>"+
			            "<div class='form-actions'>"+
			                "<button type='submit' class='btn btn-blue'>Adicionar Curso</button>"+
			            "</div>"+
			            "<input type='hidden' name='old-logo' value='"+data[0].logo+"'>"+
			            "<input type='hidden' name='old-coordenador' value='"+data[0].professor_id+"'>"+
			        "</form>");
	        	
    				
		    	 		
		    	 			
		    	 		$.each(data,function(index, element){
		    	 			
		    	 					if(index>0){
		    	 						$('#coordenador').append(
		    	 								"<option value="+element.id+">"+element.nome+"</option>"
		    	 						)
		    	 					}
		    	 			
		    	 		});
		    	 	$("div.select select").val(data[0].professor_id);
	        }
		})
	}
	
	function editar_evento(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/evento/buscar_evento_editar/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
			        	if (navigator.userAgent.indexOf("Firefox") > 0) {
		    				var data_mostrar=data[0].data_formatada;
		    			}else{
		    				var data_mostrar=data[0].data;
		    			}
	        			$('#modal-body').html('');
	        			$('#modal-body').append("<form action='"+base_url+"admin/evento/editar_evento/"+id+"' method='post'>"+
	        					"<div class='padded'>"+
			                        "<div class='control-group'>"+
			                            "<label class='control-label'>Título:</label>"+
			                            "<div class='controls'>"+
			                                "<input type='text' name='evento[titulo]' value='"+data[0].titulo+"' required/>"+
			                            "</div>"+
			                        "</div>"+
			                        "<div class='control-group'>"+
			                            "<label class='control-label'>Descrição:</label>"+
			                            "<div class='controls'>"+
			                            "<div class='box closable-chat-box'>"+
			                                            "<div class='chat-message-box'>"+
			                                				"<textarea name='evento[descricao]' class='mceEditor' rows='5' required>"+data[0].descricao+"</textarea>"+
			                                			"</div>"+	
			                            "</div>"+
			                            "</div>"+
			                        "</div>"+
			                        "<div class='control-group'>"+
		                                "<label class='control-label'>Resumo:</label>"+
		                                "<div class='controls'>"+
		                                	"<div class='box closable-chat-box'>"+
		                                        "<div class='chat-message-box'>"+
		                                    		"<textarea name='evento[resumo]' rows='5' maxlength='140' required>"+data[0].resumo+"</textarea>"+
		                                    	"</div>"+
		                                    "</div>"+	
		                                "</div>"+
		                            "</div>"+
			                        "<div class='control-group'>"+
				                        "<label class='control-label'>Data:</label>"+
				                        "<div id='data' class='controls'>"+
				                            "<input type='date' class='data' name='evento[data]' value='"+data_mostrar+"' required>"+
				                        "</div>"+
				                    "</div>"+
				                    "<div class='control-group'>"+
				                    "<label class='control-label'>Cursos:</label>"+
				                        "<div id='cursos' class='controls'>"+
				                        "</div>"+
				                    "</div>"+
			                        "<div class='form-actions'>"+
				                    	"<button type='submit' class='btn btn-blue'>Salvar Mudanças</button>"+
				                    "</div>"+
	        				"</form>");
	        			callTinymce();
	        			if (navigator.userAgent.indexOf("Firefox") > 0) {
	        				$('.data').mask("99/99/9999");
	        			}
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
	        }
	})
}

	function editar_noticia(id){
		$('#modal-body').html('');
		$.ajax({
	        url: base_url+"admin/noticia/buscar_noticia/"+id,
	        dataType: 'json',
	        type: "post",
	        success: function(data){
	        			$('#modal-body').html('');
	        			$('#modal-body').append("<form action='"+base_url+"admin/noticia/editar_noticia/"+id+"' method='post'>"+
	        					"<div class='padded'>"+
			                        "<div class='control-group'>"+
			                            "<label class='control-label'>Título:</label>"+
			                            "<div class='controls'>"+
			                                "<input type='text' name='noticia[titulo]' value='"+data[0].titulo+"' required/>"+
			                            "</div>"+
			                        "</div>"+
			                        "<div class='control-group'>"+
			                            "<label class='control-label'>Conteúdo:</label>"+
			                            "<div class='controls'>"+
			                                	"<textarea name='noticia[conteudo]' class='mceEditor' rows='5' required>"+data[0].conteudo+"</textarea>"+
			                            "</div>"+
			                        "</div>"+
			                        "<div class='control-group'>"+
			                            "<label class='control-label'>Resumo:</label>"+
			                            "<div class='controls'>"+
			                                		"<textarea name='noticia[resumo]' rows='5' required>"+data[0].resumo+"</textarea>"+
			                            "</div>"+
			                        "</div>"+
			                        "<div class='form-actions'>"+
				                    	"<button type='submit' class='btn btn-blue'>Salvar Mudanças</button>"+
				                    "</div>"+
	        				"</form>");
	        			callTinymce();
	        }
		
	})
	
}
	
