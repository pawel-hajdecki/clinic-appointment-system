<?php
/* Smarty version 5.4.5, created on 2026-01-02 15:47:33
  from 'file:DoctorsManView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6957da850503a9_19047193',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24e62e4d31bd422e34d102b9c994500dd67e8bd6' => 
    array (
      0 => 'DoctorsManView.tpl',
      1 => 1767362949,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_6957da850503a9_19047193 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16075700416957da8502ab40_45175529', "content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_16075700416957da8502ab40_45175529 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div>
    <div class="col-6">
        <a class="button primary small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showDoctorForm'), $_smarty_tpl);?>
">Dodaj</a>
    </div>
</div>
<div class="table-wrapper">
    <table id="doctorsTable" class="alt">
        <thead>
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Specjalizacje</th>
                <th style="width: 30%">Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('doctors')) == 0) {?>
                <tr>
                    <td colspan="8">Brak lekarzy.</td>
                </tr>
            <?php } else { ?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doctor');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doctor')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('doctor')->name;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('doctor')->surname;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('doctor')->specializations;?>
</td>
                    <td>
                        <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'deleteDoctor','param1'=>$_smarty_tpl->getValue('doctor')->id), $_smarty_tpl);?>
">Usuń</a>
                        <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showDoctorForm','param1'=>$_smarty_tpl->getValue('doctor')->id), $_smarty_tpl);?>
">Edytuj</a>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php }?>
        </tbody>
    </table>
</div>

<?php
}
}
/* {/block "content"} */
}
