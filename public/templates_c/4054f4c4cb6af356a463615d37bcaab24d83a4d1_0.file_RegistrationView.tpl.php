<?php
/* Smarty version 5.4.5, created on 2026-01-09 07:48:05
  from 'file:RegistrationView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6960a4a53f5c22_95812274',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4054f4c4cb6af356a463615d37bcaab24d83a4d1' => 
    array (
      0 => 'RegistrationView.tpl',
      1 => 1767941281,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6960a4a53f5c22_95812274 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20773019276960a4a53c9c72_03132319', "form_content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_20773019276960a4a53c9c72_03132319 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'register','param1'=>$_smarty_tpl->getValue('userId')), $_smarty_tpl);?>
">
	<div class="row gtr-uniform">
		<div class="col-6 col-12-xsmall">
			<input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getValue('form')->user_data->name;?>
" placeholder="Imię" />
		</div>
		<div class="col-6 col-12-xsmall">
			<input type="text" name="surname" id="surname" value="<?php echo $_smarty_tpl->getValue('form')->user_data->surname;?>
" placeholder="Nazwisko" />
		</div>
		<?php if (\core\RoleUtils::inRole('admin')) {?>
			<div class="col-12">
				<input type="text" name="login" id="login" value="<?php echo $_smarty_tpl->getValue('form')->user_data->login;?>
" placeholder="Login" />
			</div>
		<?php } else { ?>
			<div class="col-12">
				<input type="text" name="pesel" id="pesel" value="<?php echo $_smarty_tpl->getValue('form')->user_data->pesel;?>
" placeholder="PESEL" />
			</div>
		<?php }?>
        		<?php if (!$_smarty_tpl->getValue('userId')) {?>
		<div class="col-12">
			<input type="password" name="password" id="password" placeholder="Hasło" value="<?php echo $_smarty_tpl->getValue('form')->password;?>
" />
		</div>
		<div class="col-12">
			<input type="password" name="confirm_password" id="confirm_password" placeholder="Potwierdź hasło" value="<?php echo $_smarty_tpl->getValue('form')->password_confirm;?>
" />
		</div>
		<?php }?>
		<div class="col-12">
			<input type="submit" value="Zarejestruj się" class="primary" />
		</div>
	</div>
</form>

<?php
}
}
/* {/block "form_content"} */
}
