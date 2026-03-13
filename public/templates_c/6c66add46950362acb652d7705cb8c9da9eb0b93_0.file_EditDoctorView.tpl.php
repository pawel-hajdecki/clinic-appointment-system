<?php
/* Smarty version 5.4.5, created on 2026-01-04 00:05:04
  from 'file:EditDoctorView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6959a0a04ed8a9_74086152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c66add46950362acb652d7705cb8c9da9eb0b93' => 
    array (
      0 => 'EditDoctorView.tpl',
      1 => 1767480606,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6959a0a04ed8a9_74086152 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2368403226959a0a04caf03_61697352', "form_content");
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_2368403226959a0a04caf03_61697352 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'saveDoctor','param1'=>$_smarty_tpl->getValue('doctorId')), $_smarty_tpl);?>
">
    <div class="row gtr-uniform">
        <div class="col-6 col-12-xsmall">
            <input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getValue('doctor')->name;?>
" placeholder="Imię"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="text" name="surname" id="surname" value="<?php echo $_smarty_tpl->getValue('doctor')->surname;?>
" placeholder="Nazwisko"/>
        </div>
        <div class="col-12">
            <label for="photoUrl">URL zdjęcia</label>
            <input type="text" name="photoUrl" id="photoUrl" value="<?php echo $_smarty_tpl->getValue('doctor')->photoUrl;?>
" placeholder="URL zdjęcia"/>
        </div>
        <div class="col-12">
            <label for="description">Opis</label>
            <textarea name="description" id="description" rows="4" placeholder="Opis"><?php echo $_smarty_tpl->getValue('doctor')->description;?>
</textarea>
        </div>
        <div class="col-12">
            <label>Specjalizacje</label>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('allSpecializations'), 'spec');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('spec')->value) {
$foreach0DoElse = false;
?>
                <div>
                    <input type="checkbox" name="specializations[]" id="spec_<?php echo $_smarty_tpl->getValue('spec')['id'];?>
" value="<?php echo $_smarty_tpl->getValue('spec')['id'];?>
" <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('in_array')($_smarty_tpl->getValue('spec')['id'],$_smarty_tpl->getValue('doctor')->specializations)) {?>checked<?php }?>/>
                    <label for="spec_<?php echo $_smarty_tpl->getValue('spec')['id'];?>
"><?php echo $_smarty_tpl->getValue('spec')['name'];?>
</label>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="checkbox" id="customSpecEnable" name="customSpecEnable" value="1" data-toggle-checkbox="1" data-target-show="customSpecDiv" <?php if ($_smarty_tpl->getValue('doctor')->newSpecializationsRaw != '') {?>checked<?php }?>>
            <label for="customSpecEnable">Inne specjalizacje</label>
        </div>
        <div class="col-12" id="customSpecDiv" style="display:<?php if ($_smarty_tpl->getValue('doctor')->newSpecializationsRaw != '') {?>block<?php } else { ?>none<?php }?>;">
            <label for="customSpecializations">Nowe specjalizacje (po przecinku)</label>
            <textarea name="customSpecializations" id="customSpecializations" rows="3" placeholder="np. Radiologia interwencyjna, Geriatria"><?php echo $_smarty_tpl->getValue('doctor')->newSpecializationsRaw;?>
</textarea>
        </div>
        <div class="col-12">
            <input type="submit" value="Zapisz" class="primary"/>
        </div>
    </div>
</form>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>"js/textareaCheckboxTrigger.js"), $_smarty_tpl);?>
"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block "form_content"} */
}
