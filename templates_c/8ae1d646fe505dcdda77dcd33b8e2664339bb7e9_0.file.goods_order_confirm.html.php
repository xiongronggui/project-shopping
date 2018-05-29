<?php
/* Smarty version 3.1.30, created on 2018-05-15 17:21:06
  from "E:\phpStudy\WWW\fic.xs9999\templates\goods_order_confirm.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5afaa682be91b4_16187433',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8ae1d646fe505dcdda77dcd33b8e2664339bb7e9' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\fic.xs9999\\templates\\goods_order_confirm.html',
      1 => 1524899275,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5afaa682be91b4_16187433 (Smarty_Internal_Template $_smarty_tpl) {
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
    <link rel="stylesheet" href="css/firmOrder.css">
</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div class="mobile-header">
        <span class="goback"></span> 确认订单信息
        <span class="gohome"></span>
    </div>
    <div class="firmOrder">
        <div class="wrap">
            <form action="goods_order.php?op=order_confirm" method="post" id="orderConfirm">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['id'];?>
" />
                <input type="hidden" name="goods" value="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>
" />
                <input type="hidden" name="images" value="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['images'];?>
" />
                <input type="hidden" name="price" value="<?php echo $_smarty_tpl->tpl_vars['price']->value;?>
" />
                <input type="hidden" name="total" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" />
                <input type="hidden" name="usd_rate" value="<?php echo $_smarty_tpl->tpl_vars['usd_rate']->value;?>
" />
                <div class="tit">确认订单信息</div>
                <div class="orderInfo">
                    <ul class="goodsTable">
                        <li class="head">
                            <span class="goodsImg"></span>
                            <span class="goodsName">商品</span>
                            <span class="goodsUnitPrice">单价</span>
                            <span class="goodsNum">数量</span>
                            <span class="goodsAllPrice">合计金额（美元）</span>
                            <span class="goodsAllPrice">折算金额（人民币）</span>
                        </li>
                        <li class="body">
                            <span class="goodsImg">
							<img src="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['images_show'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>
">
						</span>
                            <span class="goodsName"><?php echo $_smarty_tpl->tpl_vars['goods_info']->value['title'];?>
</span>
                            <div class="goods-units clearfix">
                            <span class="goodsUnitPrice">$1.00</span>
                            <span class="goodsNum"><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
 个</span>
                            </div>
                            <span class="goodsAllPrice">$ <?php echo $_smarty_tpl->tpl_vars['price_show']->value;?>
</span>
                            <span class="goodsAllPrice">￥ <?php echo $_smarty_tpl->tpl_vars['total_show']->value;?>
</span>
                        </li>
                        <li class="pc-hide m-total cl">
                            <p>合计金额：<span class="fr m-red">$ <?php echo $_smarty_tpl->tpl_vars['price_show']->value;?>
</span></p>
                            <p class="fr">（ 折算 <span class="m-red">￥<?php echo $_smarty_tpl->tpl_vars['total_show']->value;?>
</span> ）</p>
                        </li>
                        <li class="pc-hide m-seven">
                            <i></i>此商品不支持7天退换
                        </li>
                    </ul>
                    <?php if (count($_smarty_tpl->tpl_vars['paytype']->value) == "0") {?>
                        <div class="payWayList cl empty">
                    <?php } else { ?>
                        <div class="payWayList cl">
                    <?php }?>
                        <?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['paytype']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
                        <div class="payWay1 payWay cl" wayname="<?php echo $_smarty_tpl->tpl_vars['paytype']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
">
                            <div class="fl way">
                                <?php echo $_smarty_tpl->tpl_vars['paytype']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['name'];?>

                            </div>
                            <div class="fr price">
                                实付款：<span class="num">￥ <?php echo $_smarty_tpl->tpl_vars['total_show']->value;?>
</span>
                            </div>
                        </div>
                        <?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
                        <div class="submitOrder">
                            <div class="submitBtn"><?php if ($_smarty_tpl->tpl_vars['server_name']->value['img'] == "dueseeff") {?> 支付咨询 <?php } else { ?> 提交订单 <?php }?></div>
                        </div>
                    </div>
                    <div class="tradeTips">
                        温馨提醒
                        <br/> 1.该商品为充值兑换码，完成付款后会把兑换码通过短信发送到买家的注册手机，任何人无法修改订单及金额信息；
                        <br/> 2.您购买的是兑换码充值类商品，如果不清楚该商品用途，请务必和客服沟通确认。
                        <br/> 3. 人民币金额采用实时汇率折算，以四舍五入后的取整金额为准。
                    </div>
                </div>
                <input type="hidden" id="selectedWay" name="channel" value="" />
            </form>
        </div>
    </div>
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
>
$(document).ready(function() {
    var $way = $("#selectedWay");
    var form = $("#orderConfirm");
    var $goods = {
        data: {
            loop: 0,
            loop_time: 5000,
            order_id: 0,
            no: 0
        },
        init: function() {
            this.bindEvent();
        },
        bindEvent: function() {
            var self = this;
            // 选择支付方式
            var payWay = $(".payWayList .payWay");
            payWay.on('click', function() {
                payWay.removeClass("active");
                $(this).addClass("active");
                $("#selectedWay").val($(this).attr("wayname"));
            }).eq(0).trigger('click');

            // 购买咨询
            $(".submitBtn").on('click', function() {
                // 微信显示二维码
                if ($way.val() == '微信支付') {
                    self.getScanPay();
                    return;
                }
                if ($way.val() == '人工支付') {
                    self.getPeoPay();
                    return;
                }
                $.ajaxF({
                  url:form.attr('action'),
                  data:self.getFormData(),
                  success:function(data){
                    if(data.msg){
                      $.alert(data.msg,function(){
                        if (data.url) {
                          window.location.href = data.url;
                        }
                      });
                    }else if(data.url){
                      window.location.href = data.url;
                    }
                  },
                  fail:function(data){
                    $.alert(data.msg,function(){
                      if (data.url) {
                        window.location.href = data.url;
                      }
                    });
                  }
                });
                //$("#orderConfirm").submit();
            });
        },
        getFormData: function() {
            // 获取订单数据
            var sendData = {};
            $.each(form.serializeArray(), function(i, d) {
                sendData[d.name] = $.trim(d.value);
            });
            return sendData;
        },
        pay_qrcode: function(url) {
            //显示二维码支付
            var self = this;
            var modal = $.modal({
                text: '<img src="' + url + '" width="180" height="180" style="margin-top:28px;border: 1px solid #d1d1d1;"><p style="padding-top: 20px;color:#848484;">请使用' + $way.val() + '扫描二维码支付</p>',
                close: 1,
            });
            var closeModal = function(modal) {
                self.data.loop = 0; //关闭循环
                $.closeModal(modal);
            }
            //关闭按钮回调
            $(modal).find(".modal-close a").on('click', function() {
                closeModal();
            });
            //成功付款后关闭弹窗
            self.getScanPayStatus(function() {
                closeModal();
                $.alert('订单提交成功', function() {
                    window.location.href = '/shopp/ucenter.php';
                });
            });
        },
        getScanPay: function() {
            //二维码支付订单提交
            var self = this;
            $.ajaxF({
                url: './goods_order.php?op=order_confirm',
                data: self.getFormData(),
                success: function(data) {
                    self.data.order_id = data.data.id;
                    self.data.loop = 1;
                    self.data.no = data.data.order_id;
                    $.ajaxF({
                        url: './goods_order.php?op=order_pay',
                        data: {
                            id: self.data.order_id,
                        },
                        success: function(data) {

                            self.pay_qrcode(data.data);
                        }
                    });
                }
            });
        },
        getPeoPay: function() {
            var self = this;
            $.ajaxF({
                aysnc: false,
                url: './goods_order.php?op=order_confirm_ajax',
                data: self.getFormData(),
                success: function(data) {
                    $.alert('订单提交成功', function() {
                        $.live800();
                        window.location.href = 'ucenter.php';
                    });
                }
            });
        },
        getScanPayStatus: function(cb) {
            //获取支付二维码状态
            var self = this;
            var run = function() {
                if (!self.data.loop) return;
                $.ajaxF({
                    beforeSend: function() {
                        return true;
                    },
                    complete: function() {
                        return true;
                    },
                    url: './goods_order.php?op=is_pay',
                    data: {
                        order_id: self.data.no
                    },
                    success: function(data) {
                        cb && cb();
                    },
                    fail: function(data) {
                        setTimeout(run, self.data.loop_time);
                    }
                });
            }
            setTimeout(run, self.data.loop_time);
        }
    }
    $goods.init();
});
<?php echo '</script'; ?>
>

</html><?php }
}
