<!--
	Tipo: Abrir Paginas
	Descripcion: Codigo HTML para abrir las paginas que se muestran, donde se relacionan estilos a usar
-->
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" href="<?= base_url();?>/node_modules/ng-table/bundles/ng-table.min.css">
  	<style type="text/css">
  		legend{
			color: #333;
			border-bottom: none;
			margin-bottom: 0px;
			padding-left: 10px;
		}
		fieldset{
			padding: 15px; 
			border: 1px solid #333; 
			border-radius: 4px;
			margin-bottom: 20px;
			margin-top: 20px;
		}
		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
		.navbar-default {
		    background-color: #337ab7;
		    border-color: #e7e7e7;
		    color: #FFFFFF;
		}
		.navbar-default .navbar-brand {
		    color: #FFFFFF;
		}
		.navbar-default .navbar-nav>li>a {
		    color: #FFFFFF;
		}
  	</style>
</head>
<body>