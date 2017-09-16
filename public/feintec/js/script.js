	var base_url="http://localhost/cimol/";
	
	//Oculta os elementos da classe conteudo
	$('.conteudo').fadeOut();
	var telefone = '<input class="entrada-dados" type="text" placeholder="Telefone">';
	var addAluno = '</br><h3>Dados do Aluno</h3></br><input class="Campform" type="text" name="matricula" placeholder="Matrícula"></br></br><select class="Campform"><option value="" disabled="disabled" selected="selected">Tamanho de Camiseta</option><option value="PP">PP</option><option value="P">P</option><option value="M">M</option><option value="G">G</option><option value="GG">GG</option><option value="XG">XG</option></select></br></br><select id="tipoCamisa" class="Campform"><option value="" disabled="disabled" selected="selected">Estilo de Camiseta</option><option value="babyLook">Baby Look</option><option value="comum">Comum</option></select>';
	
	salvar();
	mostra();

	function salvar(){
		$('form').submit(function(){
			var dados = $(this).serialize();
			$.ajax({
				type: "post",
				url: "feintec/inscricao",
				dataType: "html",
				data: dados,
				success: function(data){
					if (data == true) {
						$('.success').html("Dados salvos com sucesso!");
					}
				}
			});

			return false;
		});

	}


	function addCampos(cont,local){
		return local.append(cont);
	}

	function mostra(){
		$('#lista-menu li a').click(function(){
			var view = $(this).attr('data-content');
			console.log('#'+view);	
			//VERIFICA SE A DIV ESTÁ VISIVEL
			$('.conteudo').fadeOut(300);
			$('#'+view).fadeIn(300);
		});
	}
	
	
	//ABRE MODAL
	$('.novo').click(function(){
		$('.modal').fadeIn(300);
	});
	
	$('#menu-aluno li').click(function(){
		//VERIFICA SE A DIV ESTÁ VISIVEL

		//SELECIONA O CONTEÚDO
		switch($(this).text()){
			case 'Projeto':
				$(this).after($('#projeto').slideToggle(300));
				break;
			case 'Eixo':	
				$(this).after($('#eixoAluno').slideToggle(300));
				break;
			case 'Aluno':
				$(this).after($('#aluno').slideToggle(300));
				break;
			case 'Orientador':	
				$(this).after($('#orientador').slideToggle(300));
				break;
		}
	});
	$('#addAluno').click(function(){
		cont = addAluno;
		local = $('#aluno .formulario');
		local.append(cont);
	});
	
	
	
	//Angular
	var app = angular.module('feintecApp', []);
	app.controller('content', function($scope, $http) {
		function atualizarListaAlunos(){
			
			$http.post(base_url+'feintec/aluno/listar').success(function(data){
				console.log(data);
				console.log(data.alunos);
				$scope.alunos = data.alunos;
			});
		}
		atualizarListaAlunos();
		
		
		
		
	});
	
	app.controller('inscricao',function($scope, $http){
		/*$http.post(base_url+'feintec/eixo/listar').success(function(data){
			
			$scope.eixos = data.eixos;
		});*/
		$scope.enviarInscricao = function(){
			console.log($scope.eixo[1]);
			/*$http.postbase_url+'feintec/projeto/salvar',{"titulo":$scope.titulo,"resumo":$scope.resumo,}).success(function(data){
				
			});*/
		}
	});
	
	
	
	