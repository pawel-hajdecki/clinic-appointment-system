<?php
/* Smarty version 5.4.5, created on 2026-01-09 02:03:36
  from 'file:MyAccountView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_696053e8562197_89535762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6de729ee451dfb27fb05e4211d361ebf59d0825' => 
    array (
      0 => 'MyAccountView.tpl',
      1 => 1767920433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_696053e8562197_89535762 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_316057100696053e8539f65_76106905', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_316057100696053e8539f65_76106905 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div class="table-wrapper">
    <table>
        <tbody>
            <tr>
                <th>Imię</th>
                <td><?php echo $_smarty_tpl->getValue('user')->name;?>
</td>
            </tr>
            <tr>
                <th>Nazwisko</th>
                <td><?php echo $_smarty_tpl->getValue('user')->surname;?>
</td>
            </tr>
            <?php if ($_smarty_tpl->getValue('user')->pesel) {?>
            <tr>
                <th>PESEL</th>
                <td><?php echo $_smarty_tpl->getValue('user')->pesel;?>
</td>
            </tr>
            <?php }?>
            <tr>
                <th>Status konta</th>
                <td><?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('lng_user_status')->handle(array('status'=>$_smarty_tpl->getValue('user')->status), $_smarty_tpl);?>
</td>
            </tr>
        </tbody>
    </table>
</div>

<?php
}
}
/* {/block "content"} */
}
