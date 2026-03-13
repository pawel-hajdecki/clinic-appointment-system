<?php
/* Smarty version 5.4.5, created on 2025-12-29 18:08:17
  from 'file:EditVisitReasonView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_6952b5814a3407_50988335',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cae7aedd194b8d01af57dd36d66a3b6c9327cce' => 
    array (
      0 => 'EditVisitReasonView.tpl',
      1 => 1767028093,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6952b5814a3407_50988335 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_85445776952b581493be2_30256339', "form_content");
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "form_base.tpl", $_smarty_current_dir);
}
/* {block "form_content"} */
class Block_85445776952b581493be2_30256339 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<form method="post" action="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'saveVisitReason','param1'=>$_smarty_tpl->getValue('visitReasonId')), $_smarty_tpl);?>
">
    <div class="row gtr-uniform">
        <div class="col-12 col-12-xsmall">
            <input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->getValue('visitReason')->name;?>
" placeholder="Nazwa"/>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="checkbox" id="isEnable" name="isEnable" value="1" <?php if ($_smarty_tpl->getValue('visitReason')->isEnable) {?>checked<?php }?>>
			<label for="isEnable">Dostępna</label>
        </div>				
        <div class="col-12">
            <input type="submit" value="Zapisz" class="primary"/>
        </div>
    </div>
</form>
<?php
}
}
/* {/block "form_content"} */
}
