<?php
/* Smarty version 5.4.5, created on 2026-01-09 01:50:33
  from 'file:SelectAppointmentView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_696050d98f7c09_37879020',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aded6c0b42fe9c688cf33e843fa112ff13e7978a' => 
    array (
      0 => 'SelectAppointmentView.tpl',
      1 => 1767919828,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_696050d98f7c09_37879020 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1426560079696050d98c5416_88465119', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_1426560079696050d98c5416_88465119 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div  class="row apo-list" style="justify-content: center;">
    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('appointments')) > 0) {?>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('appointments'), 'appointment');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('appointment')->value) {
$foreach0DoElse = false;
?>
    <div class="row" style="width: 80%; justify-content: center;">
        <div class="col-4 col-6-small">
            <h2><?php echo $_smarty_tpl->getValue('appointment')->date;?>
</h2>
        </div>
        <div class="col-4 col-6-small">
             <h3><?php echo $_smarty_tpl->getValue('appointment')->startTime;?>
-<?php echo $_smarty_tpl->getValue('appointment')->endTime;?>
</h3>
        </div>
        <div class="col-4 col-12-small">
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'selectAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
" class="button fit small">Wybierz</a>
        </div>
    </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    <?php } else { ?>
        <h2>Brak dostępnych wizyt</h2>
    <?php }?>
</div>

<?php
}
}
/* {/block "content"} */
}
