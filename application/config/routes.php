<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route[''] = 'site/index.php';
$route['logout'] = 'site/login/logout';
$route['login'] = 'site/login';
$route['usuario'] = 'site/usuario';
$route['usuario/autenticar'] = 'site/usuario/autenticar';
$route['usuario/esqueceu_senha'] = 'site/usuario/esqueceu_senha';
$route['usuario/alterar_senha/(:any)'] = 'site/usuario/alterar_senha/$1';
$route['usuario/alterar_senha'] = 'site/usuario/alterar_senha';
$route['usuario/registrar_alteracao_senha'] = 'site/usuario/registrar_alteracao_senha';
$route['usuario/mensagem_recuperar_senha'] = 'site/usuario/mensagem_recuperar_senha';
$route['usuario/resposta_mensagem_recuperar_senha'] = 'site/usuario/resposta_mensagem_recuperar_senha';
$route['usuario/registrar_usuario'] = 'site/usuario/registrar_usuario';
$route['usuario/solicitar_usuario'] = 'site/usuario/solicitar_usuario';
$route['perfil'] = 'site/usuario/perfil';
$route['logout'] = 'site/usuario/logout';

$route['institucional'] = 'site/institucional';

$route['noticia']= 'site/noticia';
$route['curso']='site/curso';

$route['curso/lista']='site/curso/lista';
$route['curso/informacao/(:num)']='site/curso/informacao/$1';
$route['curso/grade/(:num)']='site/curso/grade/$1';
$route['curso/(:num)']='site/curso/saiba_mais/$1';
//$route['curso/(:num)']='site/curso/index/$1';
$route['disciplina_turma/(:num)']='site/disciplina_turma/index/$1';
$route['evento']='site/evento';
$route['agenda']='site/agenda';
//$route['biblioteca']='site/biblioteca';
$route['evento/(:num)'] = 'site/evento/ver/$1';
$route['noticia/(:num)'] = 'site/noticia/saiba_mais/$1';
$route['agenda']='site/agenda';
$route['contato']='site/contato';
$route['transporte']='site/transporte';
$route['servico']='site/servico';
$route['sri']='site/sri';
$route['restrito']='site/restrito';
$route['relacionamento']='site/relacionamento';
$route['videos']='site/videos';
$route['estagio']='site/estagio';
$route['estagio/integrado']='site/estagio/integrado';
$route['login/autenticar'] = 'site/login/autenticar'; 
$route['default_controller'] = 'site/inicio';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*Testes*/
$route['evento_teste']='site/eventoTeste';
$route['evento/ecluir/(:num)']='admin/eventoTeste/excluir_evento/$1';
$route['evento/edicao/ecluir/(:num)']='admin/eventoTeste/excluir_edicao/$1';
$route['evento/edicao/painel/ecluir/(:num)/(:num)']='admin/eventoTeste/excluir_painel/$1/$2';
$route['evento/edicao/imagem/ecluir/(:num)/(:num)/(:num)']='admin/eventoTeste/excluir_imagem_edicao/$1/$2/$3';
$route['evento/edicao/painel/ecluir/(:num)/(:num)/(:num)']='admin/eventoTeste/excluir_painel_edicao/$1/$2/$3';

