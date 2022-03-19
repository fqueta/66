<!DOCTYPE html>
<html lang="pt-BR" ng-app="app">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="cleartype" content="on">
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta name="robots" content="index, follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#aa2722">
        <title>Prefeitura Presidente Olegário</title>

        <!--[if lte IE 9]>
            <script src="lib/html5.min.js"></script>
        <![endif]-->

        <link href="/css/style.css?v=2" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <main>
			@yield('content')
		</main>

		<script type="text/javascript" src="/lib/compressed.min.js"></script>
        <script type="text/javascript" src="/js/script.js"></script>

        @yield('scripts')
	</body>
</html>
