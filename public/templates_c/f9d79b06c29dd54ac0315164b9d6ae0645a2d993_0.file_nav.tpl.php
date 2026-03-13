<?php
/* Smarty version 5.4.5, created on 2026-01-09 02:00:08
  from 'file:nav.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_696053186dd702_66063678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9d79b06c29dd54ac0315164b9d6ae0645a2d993' => 
    array (
      0 => 'nav.tpl',
      1 => 1767920371,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_696053186dd702_66063678 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
?><nav id="nav">
    <ul>
        <li class="special">
            <a href="#menu" class="menuToggle"><span>Menu</span></a>
            <div id="menu">
                <ul>
                    <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showMainPage'), $_smarty_tpl);?>
">Strona główna</a></li>
                    <?php if (\core\RoleUtils::inRole("admin")) {?>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showReceptionistsMan'), $_smarty_tpl);?>
">Recepcjoniści</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showPatientsMan'), $_smarty_tpl);?>
">Pacjenci</a></li>
                    <?php } elseif (\core\RoleUtils::inRole("receptionist")) {?>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showSchedule'), $_smarty_tpl);?>
">Harmonogram</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showPatientsMan'), $_smarty_tpl);?>
">Pacjenci</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showDoctorsMan'), $_smarty_tpl);?>
">Lekarze</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>"showPredefinedVisitReasonsMan"), $_smarty_tpl);?>
">Predefiniowane przyczyny wizyt</a></li>
                    <?php } elseif (\core\RoleUtils::inRole('patient')) {?>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showSchedule'), $_smarty_tpl);?>
">Moje wizyty</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>"showDoctorsGrid"), $_smarty_tpl);?>
">Umów wizytę</a></li>
                    <?php }?>

                    <?php if (\core\RoleUtils::inAnyRole()) {?>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>'showMyAccount'), $_smarty_tpl);?>
">Moje konto</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>"logout"), $_smarty_tpl);?>
">Wyloguj</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>"login"), $_smarty_tpl);?>
">Zaloguj</a></li>
                        <li><a href="<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('url')->handle(array('action'=>"showDoctorsGrid"), $_smarty_tpl);?>
">Nasi Lekarze</a></li>
                    <?php }?>
                </ul>
            </div>
        </li>
    </ul>
</nav><?php }
}
