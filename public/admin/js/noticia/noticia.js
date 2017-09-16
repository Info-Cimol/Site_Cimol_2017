	
	function form_noticia(noticia){
		
			form="<form enctype='multipart/form-data' action='"+base_url+"admin/noticia/salvar_noticia/' method='post'  novalidate>"+
			"<div class='padded'>"+
			"<input type='hidden' name=noticia[id] value='"+noticia.id+"' />"+
            "<div class='control-group'>"+
                "<label class='control-label'>Título:</label>"+
                "<div class='controls'>"+
                    "<input type='text' name='noticia[titulo]' value='"+noticia.titulo+"' required/>"+
                "</div>"+
            "</div>"+
            "<div class='control-group'>"+
                "<label class='control-label'>Conteúdo:</label>"+
                "<div class='controls'>"+
                    	"<textarea name='noticia[conteudo]' class='mceEditor' rows='5' required>"+noticia.conteudo+"</textarea>"+
                "</div>"+
            "</div>"+
            
            "<div class='control-group'>"+
                "<label class='control-label'>Resumo:</label>"+
                "<div class='controls'>"+
                    		"<textarea name='noticia[resumo]' rows='5' required>"+noticia.resumo+"</textarea>"+
                "</div>"+
            "</div>"+
            "<div class='control-group'>"+
	            "<label class='control-label'>Imagem:</label>"+
	            "<div class='controls'>"+
	                		"<input type='file' name='noticia[imagem]' />"+
	            "</div>"+
            "</div>"+
            "<div class='control-group'>"+
            "<label class='control-label'>FEED:</label>"+
            "<div class='controls'>"+
                		"<input type='checkbox' name='noticia[feed]' />"+
            "</div>"+
        "</div>"+
            
            "<div class='form-actions'>"+
            	"<button type='submit' class='btn btn-blue'>Salvar Mudanças</button>"+
            "</div>"+
	"</form>";
			
				return form;
			 		
		}	
		
	
		function editar_noticia(id){
			$('#modal-body').html('');
			console.log(id);
			$.ajax({
		        url: base_url+"admin/noticia/buscar_noticia/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        			console.log(data);
		        			$('#modal-body').html('');
		        			$('#modal-body').append(form_noticia(data[0]));
		        			callTinymce();
		        }
			
			})
		}
		
		
		function nova_noticia(){ 
			$('#modal-body').html('');
			noticia={id:'', titulo:'',conteudo:'', resumo:''};
			
			$('#modal-body').append(form_noticia(noticia));
			callTinymce();
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
		
		
		function listar_imagens(id){
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/imagem/buscar_imagens_noticia/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	$('#modal-body').html('');
		        	$('#modal-body').append(
		        			"<div id='content' class='padded'>"+
		        			"</div>");
		        			$.each(data,function(index, element){
		        				console.log(base_url+element.url_imagem+element.nome);
		        	        	$('#content').append( 			
		        				"<div class='div-imagem-modal controls'>"+
		    					"<img src='"+base_url+element.url_imagem+element.nome+"'>"+
		    					"<br/>"+
		    					"<a class='btn btn-default botao-excluir' onclick='excluir_imagem_noticia("+element.id+","+id+");'><i class='icon-trash'></i> </a>"+
		    					"</div>"
		    					);
		        			})
		        			$('#content').after(
		        				"<div id='form-modal-imagem'>" +
		        					"<form method='POST' action='"+base_url+"admin/noticia/adicionar_imagens/' enctype='multipart/form-data'>"+
		        					"<input type='hidden' name=noticia_id value='"+id+"' />"+
		        					"<fieldset>" +
		        					"<legend>Adicionar Imagens</legend>"+
	    		    					
		        					"<input type='file' name='imagens[]' accept='image/*' multiple>"+
	    		    					"<br/>"+
	    		    					"<input type='submit' class='btn btn-blue'>Salvar Imagens</button>" +
	    		    					"</fieldset>"+
	    		    				"</form>" +
	    		    			"</div>"		
	    	        			);
		        	}
			})
		}
		
		
		
		
