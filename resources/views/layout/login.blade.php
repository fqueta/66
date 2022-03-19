<!DOCTYPE html>
<html lang="pt-BR" class="ls-theme-light-green">
<head>
	<meta name="theme-color" content="#009688">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Prefeitura Municipal de Presidente Olegário</title>
	<meta name="title" content="Prefeitura Municipal de Presidente Olegário">
	<meta name="author" content="Fixcode">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/3.7.4/stylesheets/locastyle.css">
	<link rel="stylesheet" type="text/css" href="/admin_files/css/locastyle-custom.css">
	@yield('head')
</head>
<body>
	<div class="ls-login-parent">
		<div class="ls-login-inner">
    		<div class="ls-login-container">
      			@yield('content')
			</div>
  		</div>
	</div>
  	<script src="http://code.jquery.com/jquery-2.0.1.min.js"></script>
  	<script src="//assets.locaweb.com.br/locastyle/3.7.4/javascripts/locastyle.js"></script>
    @yield('scripts')
</body>
</html>
