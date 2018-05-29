<?php
/* Smarty version 3.1.30, created on 2018-04-24 14:26:45
  from "E:\phpStudy\WWW\openepay\fic.xs9999\templates\ucenter_goods_order_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5adece254ab615_79770697',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '968d1fe23781b4390a76d6986da30e9913a8fc81' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\templates\\ucenter_goods_order_list.html',
      1 => 1524131785,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5adece254ab615_79770697 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $_smarty_tpl->tpl_vars['server_name']->value['name'];?>
</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/headFoot.css">
	<link rel="stylesheet" href="css/orderList.css">
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="mobile-header">
		<span class="goback"></span>
		订单管理
		<span class="gohome"></span>
	</div>
	<div class="orderList">
		<div class="wrap">
			<div class="titTab">
				<span class="tab active">所有订单</span>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['result']->value['nums'] != 0) {?>
			<ul class="lists">
				<li class="listDetail head">
					<span class="orderImg"></span>
					<span class="orderName">商品</span>
					<span class="orderUnitPrice">单价</span> 
					<span class="orderGoodsNum">数量</span> 
					<span class="orderPrice">合计金额（人民币）</span>
					<span class="orderStatus">交易状态</span>
					<span class="orderOperate">操作</span>
				</li>
				<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value['result']) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
				<li class="listDetail body cl" data-price="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['price_show'];?>
" data-orderid="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_id'];?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_code'];?>
">
					<span class="orderId">
						<span class="orderTime"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['addtime_show'];?>
</span>
						订单号：<span class="orderNum"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_id'];?>
</span>
					</span>
					<span class="orderId">
						<lable style='color:red'>兑换码</lable>：<span class="orderNum codepwd" style="color: red;">********</span><i class="icon-see seecode" val='<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_code'];?>
'></i>
					</span>
					<span class="orderImg eyeimg">
						<img src="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['images_show'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['goods'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['goods'];?>
">
					</span>
					<span class="orderName"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['goods'];?>
</span>
					<span class="orderUnitPrice">$1.00</span>
					<span class="orderGoodsNum"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['count'];?>
 个</span>
					<span class="orderPrice"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['total_show'];?>
（约<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['price_show'];?>
）</span>
					<span class="orderCode"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_status_show'];?>
</span>
					<span class="orderOperate">
						<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['button'];?>

					</span>
				</li>
				<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
			</ul>
			<div class="pager">
				<?php echo $_smarty_tpl->tpl_vars['result']->value['page_info'];?>

			</div>
			<?php } else { ?>
			<div style="line-height:50px;text-align:center;font-size:16px;">
				暂无订单
			</div>
			<?php }?>
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
  

	function send_sms_code(order_id)
	{
		$.ajax({
			type: "post",
			url: "ucenter.php",
			data: { "op": "send_sms_code", "order_id": order_id },
			dataType: "json",
			success: function (data) {
				alert(data.Message);
			}
		});
	}
	$(function(){
		// 发送验证码
		$('.seecode').on('click',function(){
			if($(this).hasClass('no')){
				$(this).removeClass('no').prev('.codepwd').text('********');
			}else{
				$(this).addClass('no').prev('.codepwd').text($(this).attr('val'));
			}
		});
		// 兑换
		$(".show-recharge").on('click',function(){
			var parents = $(this).parents('.listDetail');
			var data = {
				price:parents.data('price'),
				order_id:parents.data('orderid'),
				pwd:parents.data('code'),
				account:0,
				name:'',
				code:''
			};
			var self = this;
			$.modal({
				text: '<div class="re-t"><div class="re-l"><label>订单号</label></div><div class="re-c">'+data.order_id+'</div></div><div class="re-t"><div class="re-l"><label>兑换码</label></div><div class="re-c"><span>********</span><i class="icon-see"></i></div></div><div class="re-t"><div class="re-l"><label>充值金额</label></div><div class="re-c"><span class="red">'+data.price+'</span></div></div><div class="re-t"><div class="re-l"><label>交易账号</label></div><div class="re-c"><input type="tel" name="account" placeholder="请输入交易账号"/></div></div><div class="re-t"><div class="re-l"><label>姓名</label></div><div class="re-c"><input type="tel" name="name" placeholder="请输入姓名"/></div></div><div class="re-t"><div class="re-l"><label>验证码</label></div><div class="re-c"><input type="tel" name="code" class="code" maxlength="6" placeholder="请输入短信验证码"/><a href="javascript:" class="sendcode">发送验证码</a></div></div>',
				title: '<b>兑换充值</b>',
				cssClass:'modal-recharge',
				close:true,
				buttons: [
					{ 
						close:false,
						text: '兑换',
						onClick: function(modal){
							 var flag = true;
							 var _this = $(this);
							 modal.find("input").each(function(){
							 	 if($(this).triggerHandler('blur') == false){
							 	 		flag = false;
							 	 		return false;
							 	 }
							 });
							 if(flag == false) return false;
							 $.ajax({
								 	type:'post',
									url: "ucenter.php?op=change_status",
									data: data,
									beforeSend:function(){
										$.showIndicator();
									},
									complete: function () {
				            $.hideIndicator();
				          },
									dataType:'json',
									success: function (data) {
										 if(data.IsSuccess){
										 	  $.toast('兑换成功');
										 	  setTimeout(function(){
										 	  	window.location.reload();
										 	  },2000);
										 }else{
										 	 $.toast(data.Message);
										 }
									}
							 });
						},
						cssClass: 'modal-button-primary' 
					}
				]
			});
			// 初始化表单
			var modal = $(".modal-recharge");
			modal.find("input").each(function(i,d){
				$(this).on('blur',function(){
					var value = $.trim(this.value);
					data[this.name] = value;
					if(value == ''){
						$.toast($(this).attr('placeholder'));
						return false;
					}
					switch(this.name){
						case 'account':
							var reg = /^[0-9]*$/;
							if (!reg.test(value)) {
                  $.toast('交易账号格式不正确');
                  return false;
              }
							break;
						case 'name':
							var reg = /^([A-Za-z\u4E00-\u9FA5]{1,30}((?:\.|\·+)[A-Za-z\u4E00-\u9FA5]{1,30})*|[a-zA-Z]{1,30}((?:\.|\s+)[a-zA-Z]{1,30})*)$/; 
							if (!reg.test(value)) {
                  $.toast('姓名只能为英文及中文字符');
                  return false;
              }
              break;
					}
					data[this.name] = value;
				});
			});

			// 查看兑换码
			modal.find(".icon-see").on('click',function(){
				if($(this).hasClass('no')){
					$(this).removeClass('no').prev('span').text('********');
				}else{
					$(this).addClass('no').prev('span').text(data.pwd);
				}
			});

			// 发送验证码
			modal.find(".sendcode").on('click',function(){
				 if($(this).hasClass('disabled')) return;
				 var flag = true;
				 var _this = $(this);
				 modal.find("input").each(function(){
				 	 if(this.name == 'account' || this.name == 'name'){
				 	 		if($(this).triggerHandler('blur') == false){
						 	 		flag = false;
						 	 		return false;
						 	}
				 	 }
				 });
				 if(flag == false) return false;
				 $.ajax({
					 	type:'post',
						url: "ucenter.php?op=check_acc",
						data: data,
						beforeSend:function(){
							$.showIndicator();
						},
						complete: function () {
	            $.hideIndicator();
	          },
						dataType:'json',
						success: function (data) {
							 if(data.IsSuccess){
							 	  $.toast('短信验证码发送成功');
							 		_this.countdown({
		                  text: '{0}秒',
		                  succ: function () {
		                      _this.text('发送验证码');
		                  }
		              });
							 }else{
							 	 $.toast(data.Message);
							 }
						}
				 });
			});

		});
		
		$(".show-recharge").each(function(){
			$(this).parents(".orderOperate").addClass('mix-orderOperate');
		});

	});
	
	

	<?php echo '</script'; ?>
>
		}
</html><?php }
}
