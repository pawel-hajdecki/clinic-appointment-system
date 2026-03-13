<!DOCTYPE HTML>
<html>
	<head>
		<title>{$page_title|default:"Tytuł"}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{asset_url path="assets/css/main.css"}" />
		<noscript><link rel="stylesheet" href="{asset_url path="assets/css/noscript.css"}" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Przychodnia</a></h1>
						{include file="nav.tpl"}
					</header>

				<!-- Main -->
					<article id="main">
						{if $page_header}
							<header>
								<h2>{$page_header}</h2>
								<p>{$page_description}</p>
							</header>
						{/if}
						<section class="wrapper style5">
							<div class="inner">
								{block name="content"}{/block}
							</div>
						</section>
					</article>

				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
						</ul>
						<ul class="copyright">
							<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="{asset_url path="assets/js/jquery.min.js"}"></script>
			<script src="{asset_url path="assets/js/jquery.scrollex.min.js"}"></script>
			<script src="{asset_url path="assets/js/jquery.scrolly.min.js"}"></script>
			<script src="{asset_url path="assets/js/browser.min.js"}"></script>
			<script src="{asset_url path="assets/js/breakpoints.min.js"}"></script>
			<script src="{asset_url path="assets/js/util.js"}"></script>
			<script src="{asset_url path="assets/js/main.js"}"></script>
			<script src="{asset_url path="assets/js/ajaxFunctions.js"}"></script>
	</body>
</html>