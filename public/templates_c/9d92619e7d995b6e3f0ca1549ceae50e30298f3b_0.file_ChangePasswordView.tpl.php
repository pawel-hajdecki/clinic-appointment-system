<?php
/* Smarty version 5.4.5, created on 2026-01-09 02:17:36
  from 'file:ChangePasswordView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_696057307a4518_40975092',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d92619e7d995b6e3f0ca1549ceae50e30298f3b' => 
    array (
      0 => 'ChangePasswordView.tpl',
      1 => 1767921441,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_696057307a4518_40975092 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_334454462696057307970c2_68729093', "form_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_334454462696057307970c2_68729093 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'changePassword'), $_smarty_tpl);?>
">
    <div class="row gtr-uniform">
        <div class="col-12">
            <input type="password" name="new_password" id="new_password" placeholder="Nowe hasło" value="<?php echo $_smarty_tpl->getValue('form')->new_password;?>
" />
        </div>
        <div class="col-12">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Potwierdź nowe hasło" value="<?php echo $_smarty_tpl->getValue('form')->confirm_password;?>
" />
        </div>
        <div class="col-12">
            <input type="submit" value="Zmień hasło" class="primary" />
        </div>
    </div>
</form>
<?php
}
}
/* {/block "form_content"} */
}
