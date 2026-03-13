<?php
/* Smarty version 5.4.5, created on 2025-12-29 18:18:40
  from 'file:PredefinedVisitReasonManView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6952b7f07375f8_40475295',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b21692cf01a48838e47f01a2c55b2bee5412c4b8' => 
    array (
      0 => 'PredefinedVisitReasonManView.tpl',
      1 => 1767028623,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
  ),
))) {
function content_6952b7f07375f8_40475295 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18179851966952b7f071a3e4_93819876', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_18179851966952b7f071a3e4_93819876 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<div>
    <div class="col-6">
        <a class="button primary small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showVisitReasonForm'), $_smarty_tpl);?>
">Dodaj</a>
    </div>
</div>
<div class="table-wrapper">
    <table id="scheduleTable" class="alt">
        <thead>
            <tr>
                <th>Przyczyna wizyty</th>
                <th>Dostępna</th>
                <th style="width: 30%;">Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('visitReasons')) == 0) {?>
                <tr>
                    <td colspan="8">Brak predefiniowantch przyczyn wizyt.</td>
                </tr>
            <?php } else { ?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('visitReasons'), 'visitReason');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('visitReason')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('visitReason')->name;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('visitReason')->isEnable ? "TAK" : "NIE";?>
</td>
                    <td>
                        <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'deleteVisitReason','param1'=>$_smarty_tpl->getValue('visitReason')->id), $_smarty_tpl);?>
">Usuń</a>
                        <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showVisitReasonForm','param1'=>$_smarty_tpl->getValue('visitReason')->id), $_smarty_tpl);?>
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
