<?php
/* Smarty version 5.4.5, created on 2026-01-09 02:12:29
  from 'file:DoctorDetailsView.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_696055fdbb56b6_94761979',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8892c9f6aab53160c9db809b1bdc0cd2aa03ebc8' => 
    array (
      0 => 'DoctorDetailsView.tpl',
      1 => 1767921080,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_696055fdbb56b6_94761979 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_802882697696055fdb9dd74_93271730', "content");
?>
 <?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "main.tpl", $_smarty_current_dir);
}
/* {block "content"} */
class Block_802882697696055fdb9dd74_93271730 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views';
?>

<div class="box alt">
    <div class="row gtr-50 gtr-uniform">
        <div class="col-6 col-12-medium">
            <span class="image fit"><img src="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('asset_url')->handle(array('path'=>($_smarty_tpl->getValue('doctor')->photoUrl ?? "images/pic01.jpg"),'type'=>"images"), $_smarty_tpl);?>
" alt="Zdjęcie dr <?php echo $_smarty_tpl->getValue('doctor')->name;?>
 <?php echo $_smarty_tpl->getValue('doctor')->surname;?>
" /></span>
        </div>
        <div class="col-6 col-12-medium">
            <h2>Dr <?php echo $_smarty_tpl->getValue('doctor')->name;?>
 <?php echo $_smarty_tpl->getValue('doctor')->surname;?>
</h2>
            <p>Specjalizacje: <?php echo $_smarty_tpl->getValue('doctor')->specializations;?>
</p>
            <a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>"showSelectAppointment",'param1'=>$_smarty_tpl->getValue('doctor')->id), $_smarty_tpl);?>
" class="button primary fit <?php if ($_smarty_tpl->getValue('blockReservation')) {?>disabled<?php }?>"> <?php if ($_smarty_tpl->getValue('blockReservation')) {?>Twoje konto jest nieaktywne<?php } else { ?>Umów wizytę<?php }?></a>
        </div>
        <?php if ($_smarty_tpl->getValue('doctor')->description) {?>
        <p>Opis: <?php echo $_smarty_tpl->getValue('doctor')->description;?>
</p>
        <?php }?>
    </div>
</div>
<?php
}
}
/* {/block "content"} */
}
