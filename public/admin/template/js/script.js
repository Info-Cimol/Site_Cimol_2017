$('document').ready(function(){
	$(".noticia-item").hover(function(){
		var image=$(this).find('img');
		var url=image.attr('src');
		var link=$(this).find('a');
		var url_link=link.attr('href');
		var texto_titulo=$(this).find('.titulo');
		var titulo=texto_titulo.text();
		var texto_resumo=$(this).find('.resumo');
		var resumo=texto_resumo.text();
		$("#imagem-destaque").attr('src', url);
		$("#link-imagem-destaque").attr('href', url_link);
		$("#titulo").html(titulo);
		$("#resumo").html(resumo);
	});
	$(".outras-imagens").hover(function(){
		var image=$(this).find('img');
		var url=image.attr('src');
		$("#imagem-mostrando").attr('src',url);
	});
});