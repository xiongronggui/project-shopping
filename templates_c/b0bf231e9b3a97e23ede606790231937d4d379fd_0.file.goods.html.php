<?php
/* Smarty version 3.1.30, created on 2018-04-05 12:45:49
  from "/u01/nginx/html/fic.sxgcsy.top/templates/goods.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ac5a9fd1d9c11_29430459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0bf231e9b3a97e23ede606790231937d4d379fd' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/templates/goods.html',
      1 => 1522903542,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5ac5a9fd1d9c11_29430459 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $_smarty_tpl->tpl_vars['server_name']->value['name'];?>
</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/headFoot.css">
	<link rel="stylesheet" href="css/buyGoods.css">
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="mobileNav cl">
		<span class="navIcon fr">
			<img src="img/openmenu_icon.png" />
		</span>
		<div class="navList fr">
		<?php if (!$_SESSION['members']['info']['id']) {?>
			<span class="toPwdLogin">登录</span>
			<span class="regist">注册</span>
		<?php } else { ?>
			<span class="userName"><?php echo $_SESSION['members']['info']['realname'];?>
</span>
			<!--<span class="changePwd">修改密码</span>-->
			<span class="myOrder"><a href="ucenter.php">我的订单</a></span>
			<span class="changePwd"><a href="ucenter.php?op=logout">退出</a></span>
		<?php }?>
		</div>
	</div>
	<div class="goods">
		<form action="goods_order.php" method="post" class="goodsForm">
		<div class="wrap">
			<div class="goodsTop cl">
				<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['id'];?>
" />
				<input type="hidden" id="usd_rate" name="usd_rate" />
				<div class="goodsImg fl">
					<img src="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['images_show'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>
"/>
				</div>
				<div class="fr goodsInfo">
					<div class="goodsTitle">
						<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>

					</div>
					<div class="unit-price">
						价格:<span class="priceNum">¥1.00</span>
					</div>
					<div class="chooseMoney">
						<div class="tit">
							数量选择
						</div>
						<div class="choose">
							<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['sell_list']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
							<span class="moneys last" data-val="<?php echo $_smarty_tpl->tpl_vars['sell_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['price'];?>
"><?php echo $_smarty_tpl->tpl_vars['sell_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['type'];?>
</span>&nbsp;&nbsp;
							<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
						</div>
						<input type="text" class="input fl" id="inputMoney" name="price" placeholder="最小输入500"><span class="inputLabel">个</span><br/>
						<p class="inputMoneyTip fl">最小输入500</p>
					</div>
					<?php if (!$_SESSION['members']['info']['id']) {?>
					<div class="toPwdLogin buyNowBtn">
						立即购买
					</div>
					<?php } else { ?>
					<div class="buyNow buyNowBtn">
						立即购买
					</div>
					<?php }?>
				</div>
			</div>
			<div class="goodsDetail">
				<!--div class="tit">
					商品详情
				</div-->
				<div class="detail"><?php echo $_smarty_tpl->tpl_vars['goods_info']->value['content'];?>
</div>
			</div>
		</div>
		</form>
	</div>
	<div class="mask"></div>
	<!--注册-->
	<div class="register">
		<form action="user.php?op=reg" method="post">
			<input type="hidden" name="type_id" value="1" />
			<span class="close">&times;</span>
			<div class="tit">注册</div>
			<input type="text" class="mobile input" name="mobile" placeholder="请输入手机号码"/>
			<span class="tips fl"></span>
			<input type="password" class="pwd input" name="password" placeholder="设置密码"/>
			<span class="tips fl"></span>
			<input type="text" class="name input" name="realname" placeholder="姓名"/>
			<span class="tips fl"></span>
			<input type="text" class="cardId input" name="people_id" placeholder="身份证号"/>
			<span class="tips fl"></span>
			<div class="input verify">
				<input type="text" class="verifyCode" name="code" placeholder="手机验证码">
				<span class="getCode active" typeId="1">获取验证码</span>
			</div>
			<span class="tips fl"></span>
			<div class="nowRegister">
				立即注册
			</div>
		</form>
	</div>
	<!--
	<div class="registerSuccess">
		<span class="close">&times;</span>
		<img src="img/bing_icon.png" alt="注册成功" class="successImg">
		<div class="success">恭喜您，注册成功!</div>
		<div class="toPwdLogin">
			登录
		</div>
	</div>
	-->
	<!--密码登录-->
	<div class="pwdLogin">
		<form action="user.php?op=login" method="post">
			<input type="hidden" name="tid" value="0" />
			<span class="close">&times;</span>
			<span class="toCodeLogin">验证码登录</span>
			<div class="tit">密码登录</div>
			<input type="text" class="input mobile" name="mobile" placeholder="请输入手机号码">
			<span class="tips fl"></span>
			<input type="password" class="input pwd" name="password" placeholder="请输入密码">
			<span class="tips fl"></span>
			<div class="pwdLoginBtn">
				登录
			</div>
			<div class="forgetOrRegister">
				<span class="fr forget">忘记密码</span>
				<span class="fr regist">免费注册</span>
			</div>
		</form>
	</div>
	<!--验证码登录-->
	<div class="codeLogin">
		<form action="user.php?op=login" method="post">
			<input type="hidden" name="tid" value="1" />
			<input type="hidden" name="type_id" value="0" />
			<span class="close">&times;</span>
			<span class="toPwdLogin">密码登录</span>
			<div class="tit">验证码登录</div>
			<input type="text" class="input mobile" name="mobile" placeholder="请输入手机号码">
			<span class="tips fl"></span>
			<div class="input verify">
				<input type="text" class="verifyCode" name="code" placeholder="手机验证码">
				<span class="getCode active" typeId="0" >获取验证码</span>
			</div>
			<span class="tips fl"></span>
			<div class="codeLoginBtn">
				登录
			</div>
			<div class="forgetOrRegister">
				<span class="fr regist">免费注册</span>
			</div>
		</form>
	</div>
	<!--密码找回-->
	<div class="getBackPwd">
		<form action="user.php?op=back" method="post">
			<input type="hidden" name="type_id" value="2" />
			<span class="close">&times;</span>
			<div class="tit">找回密码</div>
			<input type="text" class="mobile input" name="mobile" placeholder="请输入手机号码"/>
			<span class="tips fl"></span>
			<div class="input verify">
				<input type="text" class="verifyCode" name="code" placeholder="手机验证码">
				<span class="getCode active" typeId="2">获取验证码</span>
			</div>
			<span class="tips fl"></span>
			<input type="password" class="pwd input" name="password" placeholder="请输入新密码"/>
			<span class="tips fl"></span>
			<div class="getBackSure">
				确定
			</div>
		</form>
	</div>
	<!--
	<div class="getBackPwdSuccess">
		<span class="close">&times;</span>
		<img src="img/bing_icon.png" alt="注册成功" class="successImg">
		<div class="success">恭喜您，找回密码成功!</div>
		<div class="toPwdLogin">
			登录
		</div>
	</div>
	-->
<?php $_smarty_tpl->_subTemplateRender("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/public.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/buyGoods.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	$(document).ready(function () {
		$.ajax({
            type: "post",
            url: "https://crmapi.xs9999.com/Config/GetExchangeRate",
            data: {
            	type:1,
            	isForSite:1
            },
            dataType: "json",
            success: function (data) {
                if (data.IsSuccess) {
                    data = data.Message;
                    var date = new Date(data.time.replace(/-/g, '/'));
                    $("#usd_rate").val(data.mj_rmb);
                }
            }
        });
	});
	<?php echo '</script'; ?>
>
<?php echo '</script'; ?>
>
</html><?php }
}
