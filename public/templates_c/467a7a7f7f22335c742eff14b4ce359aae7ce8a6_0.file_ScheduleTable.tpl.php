<?php
/* Smarty version 5.4.5, created on 2026-03-13 22:21:10
  from 'file:ScheduleTable.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69b47fc68c0700_56987019',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '467a7a7f7f22335c742eff14b4ce359aae7ce8a6' => 
    array (
      0 => 'ScheduleTable.tpl',
      1 => 1773436868,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69b47fc68c0700_56987019 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
echo '<script'; ?>
>
    const localPaginationPreset =['scheduleFilterForm', '<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
showSchedulePart','scheduleTableWrapper'];
<?php echo '</script'; ?>
>

    <table id="scheduleTable" class="alt">
        <thead>
            <tr>
                <th>Data</th>
                <th>Godzina</th>
                <th>Gabinet</th>
                <th>Lekarz</th>
                <?php if ($_smarty_tpl->getValue('isPatient')) {?>
                    <th>Przyczyna wizyty</th>
                <?php } else { ?>
                    <th>Wolny</th>
                <?php }?>
                <th style="width: 10%;">Akcje</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('appointments')) == 0) {?>
                <tr>
                    <td colspan="8">No appointments.</td>
                </tr>
            <?php } else { ?>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('appointments'), 'appointment');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('appointment')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->date;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->startTime;?>
-<?php echo $_smarty_tpl->getValue('appointment')->endTime;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->officeName;?>
</td>
                    <td><?php echo $_smarty_tpl->getValue('appointment')->doctor->name;?>
 <?php echo $_smarty_tpl->getValue('appointment')->doctor->surname;?>
</td>
                    <?php if ($_smarty_tpl->getValue('isPatient')) {?>
                        <td><?php echo $_smarty_tpl->getValue('appointment')->visitReason;?>
</td>
                    <?php } else { ?>
                        <td><?php echo $_smarty_tpl->getValue('appointment')->isAvailable ? "TAK" : "NIE";?>

                            <?php if (!$_smarty_tpl->getValue('appointment')->isAvailable) {?>
                            <br/>
                            <?php echo $_smarty_tpl->getValue('appointment')->patientName;?>
 <?php echo $_smarty_tpl->getValue('appointment')->patientSurname;?>
 (<?php echo $_smarty_tpl->getValue('appointment')->patientPesel;?>
)
                            <br/>
                            <?php echo $_smarty_tpl->getValue('appointment')->visitReason;?>

                            <?php }?>
                        </td>
                    <?php }?>
                    <td>
                        <?php if ($_smarty_tpl->getValue('isPatient')) {?>
                            <?php if (!$_smarty_tpl->getValue('appointment')->isAvailable) {?>
                                <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'cancelAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Anuluj</a>
                            <?php }?>
                        <?php } else { ?>
                            <a class="button primary fit small" onclick="confirmLink('<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'deleteAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
', 'Czy na pewno chcesz usunąć tę wizytę?')">Usuń</a>
                            <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'editAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Edytuj</a>
                            <?php if ($_smarty_tpl->getValue('appointment')->isAvailable == true) {?>
                                <a class="button primary fit small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'bookAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
">Umów</a>
                            <?php } else { ?>
                                <a class="button primary fit small" onclick="confirmLink('<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'cancelAppointment','param1'=>$_smarty_tpl->getValue('appointment')->id), $_smarty_tpl);?>
', 'Czy na pewno chcesz anulować tą wizytę?')">Anuluj</a>
                            <?php }?>
                        <?php }?>
                    </td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php }?>
        </tbody>
    </table>
<?php if ($_smarty_tpl->getValue('pagination')->isPreviousPage || $_smarty_tpl->getValue('pagination')->isNextPage) {?>
<div class="pagination">
    <button <?php if (!$_smarty_tpl->getValue('pagination')->isPreviousPage) {?>disabled <?php }?>class="primary small icon solid fa-chevron-left" onclick="changePage(<?php echo $_smarty_tpl->getValue('pagination')->currentPage-1;?>
, ...localPaginationPreset);"></button>
    <button id="shv-nextPage" <?php if (!$_smarty_tpl->getValue('pagination')->isNextPage) {?>disabled <?php }?> class="primary small icon solid fa-chevron-right" onclick="changePage(<?php echo $_smarty_tpl->getValue('pagination')->currentPage+1;?>
, ...localPaginationPreset)"></button>
</div>
<?php }
}
}
