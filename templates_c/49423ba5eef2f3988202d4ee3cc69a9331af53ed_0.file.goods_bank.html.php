<?php
/* Smarty version 3.1.30, created on 2018-03-28 15:11:17
  from "E:\phpStudy\WWW\openepay\fic.xs9999\templates\goods_bank.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5abb4015f07483_88101251',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49423ba5eef2f3988202d4ee3cc69a9331af53ed' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\templates\\goods_bank.html',
      1 => 1522221074,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html ' => 1,
  ),
),false)) {
function content_5abb4015f07483_88101251 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/headFoot.css">
    <link rel="stylesheet" href="css/goods_bank.css">
</head>

<body class="bank">
    <?php $_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div class="wrap">
      <ul class="banklist cl">
       <?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['bank_list']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
         <li>
              <div class="li-c">
                  <i class="icon-bank icon-bank-<?php echo $_smarty_tpl->tpl_vars['bank_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
" ></i>
              </div>
          </li>
       <?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
      </ul>
      <form action="goods_order.php?op=order_pay" method="post" id="orderConfirm">
        <input type="hidden" id="id" value='0'>
        <input type="hidden" id="sel_bank" name="sel_bank">
        <a class="modal-button modal-button-primary btn-buy">支付</a>
      </form>
    </div>
    <?php $_smarty_tpl->_subTemplateRender("file:footer.html ", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
<?php echo '<script'; ?>
 src="js/jquery.min.js "><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/public.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
(function($){
  $('#id').val($.getParams('id'));
  $('.banklist li').click(function(){
    var cla = $(this).find('i').attr('class');
    var bank = cla .substr(cla .lastIndexOf("-")+1);
      $('#sel_bank').val(bank);
      $('.banklist li').removeClass('active');
      $(this).addClass('active');
    });
  $('.modal-button').click(function(){
      var  bank = $('#sel_bank').val();
      if(bank == ""){
        alert('请选择银行');
        return;
      }
      $("#orderConfirm").attr('action','goods_order.php?op=order_pay&id='+$('#id').val()+'&bankcode='+bank);
      $("#orderConfirm").submit();
  });
})(jQuery);
    
<?php echo '</script'; ?>
>
</html><?php }
}
