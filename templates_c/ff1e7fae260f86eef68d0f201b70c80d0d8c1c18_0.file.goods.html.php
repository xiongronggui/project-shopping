<?php
/* Smarty version 3.1.30, created on 2018-05-10 17:58:01
  from "E:\phpStudy\WWW\fic.xs9999\templates\goods.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5af417a9087c35_62684978',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff1e7fae260f86eef68d0f201b70c80d0d8c1c18' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\fic.xs9999\\templates\\goods.html',
      1 => 1525421188,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5af417a9087c35_62684978 (Smarty_Internal_Template $_smarty_tpl) {
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
            <span class="regist">注册</span> <?php } else { ?>
            <span class="userName"><?php echo $_SESSION['members']['info']['realname'];?>
</span>
            <!--<span class="changePwd">修改密码</span>-->
            <span class="myOrder"><a href="ucenter.php">我的订单</a></span>
            <span class="changePwd"><a href="ucenter.php?op=logout">退出</a></span> <?php }?>
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
" />
                    </div>
                    <div class="fr goodsInfo">
                        <div class="goodsTitle">
                            <?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>

                        </div>
                        <div class="unit-price">
	                        	<span class="priceUnit">单价:</span> $<span class="priceNum">1.00</span>
                            <p>促销信息：暂无</p>
                        </div>
                        <div class="goods-info">
                            <ul class="goods-num clearfix">
                                <li class="first">运费：<span>免运费</span></li>
                                <li class="border">|</li>
                                <li>累计销量：<span><?php echo $_smarty_tpl->tpl_vars['number']->value;?>
</span> 笔</li>
                                <li class="last"><span>产品参数：</span>1个按照 $1.00充值</li>
                            </ul>
                        </div>
                        <div class="chooseMoney">
                            <div class="tit">
                                购买数量：
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
</span>
                                <?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
                            </div>
                        </div>
                        <div class="chooseMoney choose-other">
                            <div class="tit">
                                其他：
                            </div>
                            <div class="choose">
                                <input type="text" style="display: none;" name="test">
                                <input type="text" class="input fl" id="inputMoney" name="price">
                                <span class="inputLabel">个</span>
                                <p class="inputMoneyTip fl">（ 输入数量需大于50 ）</p>
                            </div>
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
                <ul class="goods-infos clearfix">
                	<li>
                		<i class="icon-details"></i>
                		<span>正品保障</span>
                	</li>
                	<li>
                		 <i class="icon-details02"></i>
                		<span>不支持7天退换</span>
                	</li>
                	<li>
                		<i class="icon-details03"></i>
                		<span>极速到账</span>
                	</li>
                </ul>
                <div class="goodsDetail">
						        <div class="tit">
						        	<span>商品详情</span>
										</div>
                    <!--<div class="detail"><?php echo $_smarty_tpl->tpl_vars['goods_info']->value['content'];?>
</div>-->
                    <div class="detail">
                    	<i class="icon-empty"></i>
                    	<p>暂无详情</p>
                    </div>

                    <div class="tips">
                    	<h5>温馨提示</h5>
                    	<p>1. 该商品为数字货币充值，完成付款后会把充值码发送给买家注册手机，任何卖家无法修改订单及金额信息；</p>
                    	<p>2. 您购买的是数字货币充值类商品，如果不清楚该商品用途，请务必和客服沟通确认。</p>
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
            <input type="text" class="mobile input" name="mobile" placeholder="请输入手机号码" />
            <span class="tips fl"></span>
            <input type="password" class="pwd input" name="password" placeholder="设置密码" />
            <span class="tips fl"></span>
            <?php if ($_smarty_tpl->tpl_vars['netinfo']->value['name']) {?>
                <input type="text" class="name input" name="realname" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['netinfo']->value['name'];?>
" placeholder="姓名" />
            <?php } else { ?>
                 <input type="text" class="name input" name="realname" placeholder="姓名" />
             <?php }?>
            <span class="tips fl"></span>
            <?php if ($_smarty_tpl->tpl_vars['netinfo']->value['idcard']) {?>
                <input type="text" class="cardId input" name="people_id" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['netinfo']->value['idcard'];?>
" placeholder="身份证号" />
            <?php } else { ?>
                <input type="text" class="cardId input" name="people_id" placeholder="身份证号" />
            <?php }?>
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
                <span class="getCode active" typeId="0">获取验证码</span>
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
            <input type="text" class="mobile input" name="mobile" placeholder="请输入手机号码" />
            <span class="tips fl"></span>
            <div class="input verify">
                <input type="text" class="verifyCode" name="code" placeholder="手机验证码">
                <span class="getCode active" typeId="2">获取验证码</span>
            </div>
            <span class="tips fl"></span>
            <input type="password" class="pwd input" name="password" placeholder="请输入新密码" />
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
if ($('.priceNum').html().indexOf('¥') >= 0) {
    $(document).ready(function() {
        $.ajax({
            type: "post",
            url: "https://crmapi.xs9999.com/Config/GetExchangeRate",
            data: {
                type: 1,
                isForSite: 1
            },
            dataType: "json",
            success: function(data) {
                if (data.IsSuccess) {
                    data = data.Message;
                    var date = new Date(data.time.replace(/-/g, '/'));
                    $("#usd_rate").val(data.mj_rmb);
                }
            }
        });
    });
} else {
    $(document).ready(function() {
        $.ajax({
            url: "http://api.xsmcfx.com/Pay/GetDepositDollarToRMBExchangeRate",
            type: "POST",
            dataType: 'json',
            anync: true,
            success: function(data) {
                if (data.IsSuccess) {
                    var usd_rate = data.Message;
                    $("#usd_rate").val(usd_rate);
                }
            },
        });
    });
}
<?php echo '</script'; ?>
>

</html><?php }
}
