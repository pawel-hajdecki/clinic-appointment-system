<?php
/* Smarty version 5.4.5, created on 2025-12-29 12:38:38
  from 'file:EditAppointmentView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6952683ead70d6_39708204',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3da8c812bac19d8a798e411296226709369cca0' => 
    array (
      0 => 'EditAppointmentView.tpl',
      1 => 1767008294,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6952683ead70d6_39708204 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20273206496952683ea9e6c4_57326016', "form_content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_20273206496952683ea9e6c4_57326016 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'saveAppointment','param1'=>$_smarty_tpl->getValue('appointmentId')), $_smarty_tpl);?>
">
    <div class="row gtr-uniform">
        <div class="col-12 col-12-xsmall">
            <input type="text" name="date" id="date" value="<?php echo $_smarty_tpl->getValue('appointment')->date;?>
" placeholder="Data wizyty"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="text" name="startTime" id="startTime" value="<?php echo $_smarty_tpl->getValue('appointment')->startTime;?>
" placeholder="Godzina rozpoczęcia"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="text" name="endTime" id="endTime" value="<?php echo $_smarty_tpl->getValue('appointment')->endTime;?>
" placeholder="Godzina zakończenia"/> 
        </div>
        <div class="col-6 col-12-xsmall">
            <select name="doctorId" id="doctorId">
                <option style="display: none;" value="">Wybierz lekarza</option>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('doctors'), 'doctor');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('doctor')->value) {
$foreach0DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('doctor')->id;?>
" <?php if ($_smarty_tpl->getValue('appointment')->doctorId == $_smarty_tpl->getValue('doctor')->id) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('doctor')->name;?>
 <?php echo $_smarty_tpl->getValue('doctor')->surname;?>
</option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
        </div>
        <div class="col-6 col-12-xsmall">
            <select name="officeId" id="officeId">
                <option style="display: none;" value="">Wybierz gabinet</option>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('offices'), 'office');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('office')->value) {
$foreach1DoElse = false;
?>
                    <option value="<?php echo $_smarty_tpl->getValue('office')->id;?>
" <?php if ($_smarty_tpl->getValue('appointment')->officeId == $_smarty_tpl->getValue('office')->id) {?>selected<?php }?>><?php echo $_smarty_tpl->getValue('office')->name;?>
</option>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
        </div>						
        <div class="col-12">
            <input type="submit" value="Zapisz" class="primary" />
        </div>
    </div>
</form>
<?php
}
}
/* {/block "form_content"} */
}
