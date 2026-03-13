<?php
/* Smarty version 5.4.5, created on 2026-03-13 01:46:57
  from 'file:ScheduleView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_69b35e81aa7f64_73836545',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e10e99aba6dffa291e14858b14fe8c4bd2243fc8' => 
    array (
      0 => 'ScheduleView.tpl',
      1 => 1773362812,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:messages.tpl' => 1,
    'file:ScheduleTable.tpl' => 1,
  ),
))) {
function content_69b35e81aa7f64_73836545 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_168309994569b35e81a817d7_29635947', "content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_168309994569b35e81a817d7_29635947 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>


<?php echo '<script'; ?>
>
    const localFilterPreset =['scheduleFilterForm', '<?php echo $_smarty_tpl->getValue('conf')->action_root;?>
showSchedulePart','scheduleTableWrapper'];
<?php echo '</script'; ?>
>

<div id="messages">
    <?php $_smarty_tpl->renderSubTemplate("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</div>

<?php if (!$_smarty_tpl->getValue('isPatient')) {?>
<div>
    <div class="col-6">
        <a class="button primary small" href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showNewAppointmentForm'), $_smarty_tpl);?>
">Dodaj wizytę</a>
    </div>
</div>
<div class="filter-container" style="margin-top: 2em;">
    <div class="filterIcon">
        <a class="icon solid fa-filter"></a>
    </div>
    <div class = "filterContent">
        <form id="scheduleFilterForm">
        <div class="row gtr-25 gtr-uniform">
            <div class="col-4 col-12-small">
                <input type="text" id="name" name="name" placeholder="Lekarz lub pacjent" value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')->name, ENT_QUOTES, 'UTF-8', true);?>
" 
                oninput="filterTable(...localFilterPreset, true);"
                />
            </div>
            
            <div class="col-3 col-12-small">
                <input 
                    type="<?php if ($_smarty_tpl->getValue('form')->dateTimeFrom != '') {?>date<?php } else { ?>text<?php }?>" 
                    id="dateTimeFrom" 
                    name="dateTimeFrom" 
                    placeholder="Od" 
                    value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')->dateTimeFrom, ENT_QUOTES, 'UTF-8', true);?>
" 
                    onfocus="this.type='date'" 
                    onblur="if(this.value == '') this.type='text';" 
                    onchange="filterTable(...localFilterPreset);"
                />
            </div>

            <div class="col-3 col-12-small">
                <input 
                    type="<?php if ($_smarty_tpl->getValue('form')->dateTimeTo != '') {?>date<?php } else { ?>text<?php }?>" 
                    id="dateTimeTo" 
                    name="dateTimeTo" 
                    placeholder="Do" 
                    value="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('form')->dateTimeTo, ENT_QUOTES, 'UTF-8', true);?>
" 
                    onfocus="this.type='date'" 
                    onblur="if(this.value == '') this.type='text';" 
                    onchange="filterTable(...localFilterPreset);"
                />
            </div>
            
            <div class="col-2 col-12-small">
                <select id="appointmentStatus" name="appointmentStatus" onchange="filterTable(...localFilterPreset);">
                    <option value="" <?php if ($_smarty_tpl->getValue('form')->appointmentStatus == '') {?>selected<?php }?>>Wszystkie</option>
                    <option value="1" <?php if ($_smarty_tpl->getValue('form')->appointmentStatus == '1') {?>selected<?php }?>>Wolne</option>
                    <option value="0" <?php if ($_smarty_tpl->getValue('form')->appointmentStatus == '0') {?>selected<?php }?>>Zajęte</option>
                </select>
            </div>

            <input type="hidden" id="pageInput" name="page" value="1">
        </div>
    </form>
    </div>
</div>

<?php }?>

<div id="scheduleTableWrapper" class="table-wrapper">
    <?php $_smarty_tpl->renderSubTemplate("file:ScheduleTable.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</div>

<?php
}
}
/* {/block "content"} */
}
