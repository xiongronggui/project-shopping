<?php
/* Smarty version 3.1.30, created on 2018-04-05 13:21:21
  from "E:\phpStudy\WWW\openepay\fic.xs9999\templates\header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ac5b2518e78b6_28326494',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd589d1a24e1aca7c220dd0dd814f5e25f8700bab' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\templates\\header.html',
      1 => 1522895367,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ac5b2518e78b6_28326494 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="header">

    <div class="wrap">

        <a href="goods.php" class="fl logo">

        	<img src="img/<?php echo $_smarty_tpl->tpl_vars['server_name']->value['img'];?>
/logo.png" title="" alt=""/>

        </a>

        <span class="fr user">

			<?php if (!$_SESSION['members']['info']['id']) {?>

            <span>亲，欢迎光临</span>

			<a href="javascript:;" class="toPwdLogin">请登录</a>

            <a href="javascript:;" class="regist">免费注册</a>

			<?php } else { ?>

			<span class="userName"><?php echo $_SESSION['members']['info']['realname'];?>
</span>

            <a href="ucenter.php" class="myOrder">我的订单</a>

			<!--<a href="javascript:;" class="changePwd">修改密码</a>-->

			<a href="ucenter.php?op=logout" class="changePwd">退出</a>

			<?php }?>

        </span>

    </div>

</div>

<?php }
}
