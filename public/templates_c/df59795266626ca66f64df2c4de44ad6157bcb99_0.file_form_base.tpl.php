<?php
/* Smarty version 5.4.5, created on 2025-12-29 12:35:18
  from 'file:form_base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69526776733f91_42685483',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df59795266626ca66f64df2c4de44ad6157bcb99' => 
    array (
      0 => 'form_base.tpl',
      1 => 1767008044,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_69526776733f91_42685483 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_21104967695267766a04a4_48470134', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block 'form_content'} */
class Block_1974172750695267766a0bd1_96352027 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
?>
 <?php
}
}
/* {/block 'form_content'} */
/* {block "content"} */
class Block_21104967695267766a04a4_48470134 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
?>

<div class="row" style="justify-content: center;">
	<div class="col-6 col-12-small">
		<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1974172750695267766a0bd1_96352027', 'form_content', $this->tplIndex);
?>

	</div>
	<?php if (!$_smarty_tpl->getValue('msgs')->isEmpty()) {?>
		<div class="col-6 col-12-small">
			<?php $_smarty_tpl->renderSubTemplate('file:messages.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
		</div>
	<?php }
}
}
/* {/block "content"} */
}
