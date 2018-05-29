;(function($){
		//确认支付	
		var $form = $("#form-quick");
		var $orderid = $.getParams('id') || 0;
		if(!$orderid){
			//如果没有订单id则返回首页
			window.location.href = 'goods.php';
			return;
		}
		var $quick = {
			data:{},
			init:function(){
				this.bindEvent();
			},
			bindEvent:function(){
				var self = this;
				$form.find("input").blur(function () {
					if (self.checkForm($(this)) == false) return false;
					if (this.name == 'bank'){
						self.getBankName($(this));
					}
					return true;
				});
				// 支付确认
				$(".submitBtn").on('click',function(){
					var result = true;
					$form.find("input").each(function () {
						if ($(this).is(":visible") && $(this).triggerHandler('blur') == false) {
							result = false;
							return false;
						}
					});
					if (result == false) return false;
					// 银行名称判断
					if(!$form.find("input[name=bankname]").val()){
						$.toast('银行卡号不正确！');
						return;
					}
					$.each($form.serializeArray(), function (i, d) {
						if(d.name != 'bankname'){
							self.data[d.name] = $.trim(d.value);
						}
					});
					self.confirmPay();
				});
			},
			confirmPay:function(){
				//确认支付	
				var self = this;
				$.modal({
					text: '<div style="text-align:left;">请务必确定<span style="color:red;">'+self.data.mobile+'</span>是您在开户时预留的手机号码！</div>',
					title: '提示',
					buttons: [
						{ 
							text: '返回'
						},
						{ 
							close: false,
							text: '确定', 
							onClick: function(modal){
								$.ajaxF({
									url:'./goods_order.php?op=order_pay&id='+$orderid,
									data:self.data,
									success: function (res) {
										$.closeModal(modal);
										self.modalPay();
										$.toast('手机验证码发送成功');
									}
								});
							}, 
							cssClass: 'modal-button-primary' 
						}
					]
				});
			},
			checkForm:function(dom){
				var self = this;
				var value = $.trim(dom.val());
				if (value == '') {
					self.showTips(dom, dom.attr('placeholder'));
					return false;
				}
				switch(dom[0].name){
					case 'name':
						var regchar = /^([A-Za-z\u4E00-\u9FA5]{1,30}((?:\.|\·+)[A-Za-z\u4E00-\u9FA5]{1,30})*|[a-zA-Z]{1,30}((?:\.|\s+)[a-zA-Z]{1,30})*)$/;
						if (!regchar.test(value)){
							self.showTips(dom, '姓名只能为英文及中文字符');
							return false;
						}
						break;
					case 'idcard':
						var info = $.checkCardID(value);
						if (!info.IsSuccess){
							self.showTips(dom, info.Message);
							return false;
						}
						break;
					case 'mobile':
						var reg = /^[1][3,4,5,6,7,8,9][0-9]{9}$/;  
						if (!reg.test(value)){
							self.showTips(dom, '手机号码格式不正确');
							return false;
						}
						break;
					case 'bank':
						//去除银行卡号空格
						value = value.replace(/ /g, '');
						dom.val(value);
						if (!$.checkCardNO(value)) {
							self.showTips(dom, '银行卡号不正确！');
							return false;
						}
						break;
				}
				return true;
			},
			getBankName:function(dom){
				// 获取银行卡名称
				var value = $.trim(dom.val());
				if(value == dom[0].defaultValue) return;
				var bankname = $form.find('input[name=bankname]');
				$.ajaxF({
					url:'./goods_order.php?op=card',
					beforeSend:function(){
						$.showIndicator();
						bankname.val('');
					},
					data: {
						bankcard: value,
					},
					success: function (res) {
						bankname.val(res.data.name);
						$("#bankname_text").text(res.data.name);
						dom[0].defaultValue = value;
					}
				});
			},
			modalPay:function(){
				var self = this;
				var at = self.data.mobile;
				var mobile_f = (at.substring(0, 3) + " **** " + at.substring(at.length - 4, at.length));
				$.modal({
					close:true,
					text: '<p class="status">已发送校验码到您的手机</p><span class="mobile">'+mobile_f+'</span><div class="option"><input type="number" maxlength="6" name="code" placeholder="请输入检验码"/></div>',
					title: '确认添加',
					cssClass:'modal-sendcode',
					buttons: [
						{ 
							close: false,
							text: '确定', 
							onClick: function(modal){
								var reg=$(modal);
								var code = $.trim(reg.find("input[name=code]").val());
								if(!code){
									$.toast('请输入检验码');
									return;
								}
								if(!/^[0-9]*$/.test(code)){
									$.toast('检验码格式不对');
									return;
								}
								$.ajaxF({
									url:'./goods_order.php?op=sms_commit&id='+$orderid,
									data:$.extend(self.data,{sms_code:code}),
									success:function(res){
										$.closeModal(modal);
										$.alert('支付成功',function(){
											window.location.href = './ucenter.php';
										});
									}
								});
							}, 
							cssClass: 'modal-button-primary' 
						}
					]
				});		
			},
			sendCode: function (callback) {
				// 发送验证码
				$.ajaxF({
					url: $.config.api + '/User/SendValidateCodeByRecharge',
					data: {
						orderid: $.trim($form_orderid.val()),
						password: $.trim($form_password.val()),
					},
					success: function (data) {
						callback && callback();
					}
				});
			},
			showTips:function(dom,msg){
				if(msg) $.toast(msg);
			}

			
		}
		
		$(function(){
			$quick.init();
		});
			
	})(jQuery);