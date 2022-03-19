<!DOCTYPE html>
<html lang="pt-BR" class="ls-theme-light-green" ng-app="app">
<head>
	<meta name="theme-color" content="#009688">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Prefeitura Municipal de Presidente Olegário</title>
	<meta name="title" content="Prefeitura Municipal de Presidente Olegário">
	<meta name="author" content="Fixcode">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=no">
	@yield('head')
	<link rel="stylesheet" type="text/css" href="/admin_files/css/locastyle.css">
	<link rel="stylesheet" type="text/css" href="/admin_files/css/locastyle-custom.css">
</head>
<body class="documentacao documentacao_exemplos documentacao_exemplos_painel2 documentacao_exemplos_painel2_home documentacao_exemplos_painel2_home_index" ng-app="app">
	<div class="ls-topbar">
	  <div class="ls-notification-topbar">
			<div class="ls-dropdown ls-user-account" data-ls-module="dropdown">
				<a class="ls-ico-user" href="#">
					<span class="ls-name">{!!Auth::user()->name!!}</span>
				</a>
				<nav class="ls-dropdown-nav ls-user-menu" aria-hidden="true">
					<ul>
						<li><a href="{!!action('Auth\AuthController@getLogout')!!}" role="option">Sair</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<span class="ls-show-sidebar ls-ico-menu"></span>

		<h1 class="ls-brand-name">
			<a class="ls-ico-earth" href="home">
				<small>Gerenciador de conteúdo</small>Prefeitura Municipal de Presidente Olegário
			</a>
		</h1>
	</div>

	<aside class="ls-sidebar">
		<div class="ls-sidebar-inner">
			<nav class="ls-menu" role="navigation">
				<ul role="menu">
					@if(in_array('players', Auth::user()->permissions()->lists('route')->toArray()) || in_array('banners', Auth::user()->permissions()->lists('route')->toArray()) || in_array('floaters', Auth::user()->permissions()->lists('route')->toArray()) || in_array('uploads', Auth::user()->permissions()->lists('route')->toArray()) )
						<li class="ls-submenu-parent ls-active" aria-expanded="true" aria-hidden="false">
							<a href="#" class="ls-ico-images" title="Contato" role="menuitem">Mídia</a>
							<ul class="ls-submenu" role="menu">
								@if(in_array('players', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.players.index', 'Slider', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('banners', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.banners.index', 'Banners', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('floaters', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.floaters.index', 'Floaters', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('uploads', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.file_uploads.index', 'Gerenciador de arquivos', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
							</ul>
						</li>
					@endif

					@if(in_array('pages', Auth::user()->permissions()->lists('route')->toArray()) || in_array('notices', Auth::user()->permissions()->lists('route')->toArray()) || in_array('posts', Auth::user()->permissions()->lists('route')->toArray()) )
						<li class="ls-submenu-parent ls-active" aria-expanded="true" aria-hidden="false">
							<a href="#" class="ls-ico-bullhorn" title="Contato" role="menuitem">Conteúdo</a>
							<ul class="ls-submenu" role="menu">
								@if(in_array('pages', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.pages.index', 'Páginas', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('notices', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.notices.index', 'Avisos', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('posts', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.posts.index', 'Notícias', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('diaries', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.diaries.index', 'Diário oficial', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
{{-- 							<li>
									{!!link_to_route('admin.categories.index', 'Categorias', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
								</li> --}}
							</ul>
						</li>
					@endif

					@if(in_array('biddings', Auth::user()->permissions()->lists('route')->toArray()) || in_array('bidding_categories', Auth::user()->permissions()->lists('route')->toArray()) || in_array('newsletters', Auth::user()->permissions()->lists('route')->toArray()) )
						<li class="ls-submenu-parent ls-active" aria-expanded="true" aria-hidden="false">
							<a href="#" class="ls-ico-chart-bar-up" title="Contato" role="menuitem">Licitações</a>
							<ul class="ls-submenu" role="menu">
								@if(in_array('biddings', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.biddings.index', 'Processos', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('biddings', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.biddings.index', 'Publicações Trimestrais', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('bidding_categories', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.bidding_categories.index', 'Áreas', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('newsletters', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.newsletters.index', 'Recebimento de notificações', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
							</ul>
						</li>
					@endif

					@if(in_array('sections', Auth::user()->permissions()->lists('route')->toArray()) || in_array('receivers', Auth::user()->permissions()->lists('route')->toArray()) || in_array('contacts', Auth::user()->permissions()->lists('route')->toArray()) )
						<li class="ls-submenu-parent ls-active" aria-expanded="true" aria-hidden="false">
							<a href="#" class="ls-ico-user" title="Fale conosco" role="menuitem">Fale conosco</a>
							<ul class="ls-submenu" role="menu">
								@if(in_array('sections', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.sections.index', 'Secretarias', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('receivers', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.receivers.index', 'Recebimento de e-mails', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
								@if(in_array('contacts', Auth::user()->permissions()->lists('route')->toArray()))
									<li>
										{!!link_to_route('admin.contacts.index', 'Mensagens recebidas', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
									</li>
								@endif
							</ul>
						</li>
					@endif

					@if(in_array('users', Auth::user()->permissions()->lists('route')->toArray()))
						<li class="ls-submenu-parent ls-active" aria-expanded="true" aria-hidden="false">
							<a href="#" class="ls-ico-cog" title="Configurações" role="menuitem">Configurações</a>
							<ul class="ls-submenu" role="menu">
								<li>
									{!!link_to_route('admin.users.index', 'Usuários', [], ['class' => 'ls-submenu-item', 'role' => 'menuitem'])!!}
								</li>
							</ul>
						</li>
					@endif
				</ul>
			</nav>
		</div>
		<span class="ls-sidebar-toggle ls-ico-shaft-left"></span>
	</aside>

	<main class="ls-main">
		@yield('content')
	</main>
	<script type="text/javascript" src="/admin_files/lib/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="/admin_files/lib/jquery.mask.min.js"></script>
	<script type="text/javascript" src="/admin_files/js/locastyle.js"></script>
	<script type="text/javascript" src="/admin_files/js/admin.js"></script>
  @yield('scripts')
  @yield('script')
</body>
</html>