<?php
/* Smarty version 5.4.5, created on 2025-12-24 00:23:56
  from 'file:form_base_input.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.5',
  'unifunc' => 'content_694b248cf39695_33394202',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3569f3509cecc5fd37330789ae3ee2e60f451cad' => 
    array (
      0 => 'form_base_input.tpl',
      1 => 1766532211,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_694b248cf39695_33394202 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\AS\\ClinicAppointmentsSystem\\app\\views\\templates';
?>

<?php $_smarty_tpl->assign('__id', (($tmp = $_smarty_tpl->getValue('id') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('name') ?? null : $tmp), false, NULL);
$_smarty_tpl->assign('__err', null, false, NULL);?>

<?php if ($_smarty_tpl->getValue('msgs')->isMessage($_smarty_tpl->getValue('name'))) {?>
  <?php $_smarty_tpl->assign('__err', $_smarty_tpl->getValue('msgs')->getMessage($_smarty_tpl->getValue('name'))->text, false, NULL);
}?>

<input
  type="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('type') ?? null)===null||$tmp==='' ? 'text' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
  name="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('name'), ENT_QUOTES, 'UTF-8', true);?>
"
  id="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('__id'), ENT_QUOTES, 'UTF-8', true);?>
"
  value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('value') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
  placeholder="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('placeholder') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
  class="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('class') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
  <?php if ((true && ($_smarty_tpl->hasVariable('attrs') && null !== ($_smarty_tpl->getValue('attrs') ?? null)))) {
echo $_smarty_tpl->getValue('attrs');
}?>
/>

<?php if ($_smarty_tpl->getValue('__err')) {?>
  <label for="<?php echo htmlspecialchars((string)$_smarty_tpl->getValue('__id'), ENT_QUOTES, 'UTF-8', true);?>
" class="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->getValue('error_class') ?? null)===null||$tmp==='' ? ' ' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
">
    <?php echo htmlspecialchars((string)$_smarty_tpl->getValue('__err'), ENT_QUOTES, 'UTF-8', true);?>

  </label>
<?php }
}
}
