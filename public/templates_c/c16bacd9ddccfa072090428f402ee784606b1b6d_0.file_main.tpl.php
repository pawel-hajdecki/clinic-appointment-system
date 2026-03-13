<?php
/* Smarty version 5.4.5, created on 2026-02-14 22:43:36
  from 'file:main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6990ec883ddcd8_31113076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c16bacd9ddccfa072090428f402ee784606b1b6d' => 
    array (
      0 => 'main.tpl',
      1 => 1771105177,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:nav.tpl' => 1,
  ),
))) {
function content_6990ec883ddcd8_31113076 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "Tytuł" ?? null : $tmp);?>
</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/css/main.css"), $_smarty_tpl);?>
" />
		<noscript><link rel="stylesheet" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/css/noscript.css"), $_smarty_tpl);?>
" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Przychodnia</a></h1>
						<?php $_smarty_tpl->renderSubTemplate("file:nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
					</header>

				<!-- Main -->
					<article id="main">
						<?php if ($_smarty_tpl->getValue('page_header')) {?>
							<header>
								<h2><?php echo $_smarty_tpl->getValue('page_header');?>
</h2>
								<p><?php echo $_smarty_tpl->getValue('page_description');?>
</p>
							</header>
						<?php }?>
						<section class="wrapper style5">
							<div class="inner">
								<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5298981036990ec881f37a3_69874801', "content");
?>

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
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/jquery.min.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/jquery.scrollex.min.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/jquery.scrolly.min.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/browser.min.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/breakpoints.min.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/util.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/main.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"assets/js/ajaxFunctions.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
	</body>
</html><?php }
/* {block "content"} */
class Block_5298981036990ec881f37a3_69874801 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
}
}
/* {/block "content"} */
}
