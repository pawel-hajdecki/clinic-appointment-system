<?php
/* Smarty version 5.4.5, created on 2026-03-13 00:09:43
  from 'file:messages.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69b347b7c58e20_46480844',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7217334e40971a8a0016006129079259ed6c8ed' => 
    array (
      0 => 'messages.tpl',
      1 => 1773356920,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69b347b7c58e20_46480844 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
if (!$_smarty_tpl->getValue('msgs')->isEmpty()) {?>
	<?php if ($_smarty_tpl->getValue('msgs')->isError()) {?>
		<div class="message error">
			<h3 class="icon solid fa-exclamation-triangle">Błędy</h3>
			<ol>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs')->getMessages(), 'msg');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('msg')->value) {
$foreach0DoElse = false;
?>
					<?php if ($_smarty_tpl->getValue('msg')->isError()) {?>
						<li><?php echo $_smarty_tpl->getValue('msg')->text;?>
</li>
					<?php }?>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ol>
		</div>
	<?php }?>

	<?php if ($_smarty_tpl->getValue('msgs')->isInfo()) {?>
		<div class="message success">
			<h3 class="icon solid fa-check">OK</h3>
			<?php if ($_smarty_tpl->getValue('msgs')->getNumberOfInfos() == 1) {?>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs')->getMessages(), 'info');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('info')->value) {
$foreach1DoElse = false;
?>
					<?php if ($_smarty_tpl->getValue('info')->isInfo()) {?>
						<span><?php echo $_smarty_tpl->getValue('info')->text;?>
</span>
					<?php }?>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			<?php } else { ?>
			<ol>
				<?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('msgs')->getMessages(), 'info');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('info')->value) {
$foreach2DoElse = false;
?>
					<?php if ($_smarty_tpl->getValue('info')->isInfo()) {?>
						<li><?php echo $_smarty_tpl->getValue('info')->text;?>
</li>
					<?php }?>
				<?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
			</ol>
			<?php }?>
		</div>
	<?php }
}
}
}
