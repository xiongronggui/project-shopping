(function($,win){
    var buyGoods = {
        init:function(){
            var me = this;
            me.render();
            me.bind();
        },
        data:function(){
            var me = this;
        },
        render:function(){
            var me = this;
            me.mask = $(".mask");
            me.inputMoney = $("#inputMoney");
            me.inputMoneyTip = $(".inputMoneyTip");
            me.lastMoney = $("#lastMoney");
            me.chooseMon = $(".chooseMoney .moneys");
            me.register = $(".register");
            me.registerForm = $(".register input");
            me.registerFormTips = $(".register .tips");
            me.registerSuccess = $(".registerSuccess");
            me.pwdLogin = $(".pwdLogin");
            me.pwdLoginForm = $(".pwdLogin input");
            me.pwdLoginFormTips = $(".pwdLogin .tips");
            me.codeLogin = $(".codeLogin");
            me.codeLoginForm = $(".codeLogin input");
            me.codeLoginFormTips = $(".codeLogin .tips");
            me.getBackPwd = $(".getBackPwd");
            me.getBackPwdForm = $(".getBackPwd input");
            me.getBackPwdFormTips = $(".getBackPwd .tips");
            me.getBackPwdSuccess = $(".getBackPwdSuccess");
            me.allPopup = $(".register,.registerSuccess,.pwdLogin,.codeLogin,.getBackPwd,.getBackPwdSuccess");
            me.nowRegister = $(".nowRegister");
            me.toPwdLogin = $(".toPwdLogin");
            me.toCodeLogin = $(".toCodeLogin");
            me.regist = $(".regist");
            me.forget = $(".forget");
            me.getBackPwd = $(".getBackPwd");
            me.getBackPwdSuccess = $(".getBackPwdSuccess");
            me.getBackSure = $(".getBackSure");
            me.close = $(".close");
            me.getCode = $(".getCode.active");
            me.buyNowBtn = $(".buyNow");
            me.pwdLoginBtn = $(".pwdLoginBtn");
            me.codeLoginBtn = $(".codeLoginBtn");
            me.cardId = $(".cardId");
            me.mobile = $(".mobile");
            me.pwd = $(".pwd");
            me.code = $(".verifyCode");
            me.userName = $(".name");
            me.navIcon = $(".navIcon");
            me.navList = $(".navList");
        },
        bind:function(){
            var me = this;
            me.chooseMon.click($.proxy(me["chooseMoney"],me));
            me.inputMoney.on("input",$.proxy(me["inputMoneyChange"],me));
            me.close.click($.proxy(me["closePopup"],me));
            me.getCode.click($.proxy(me["countDown"],me));
            me.nowRegister.click($.proxy(me["showRegisterSuccess"],me));
            me.toPwdLogin.click($.proxy(me["showPwdLogin"],me));
            me.toCodeLogin.click($.proxy(me["showCodeLogin"],me));
            me.regist.click($.proxy(me["showRegister"],me));
            me.forget.click($.proxy(me["showForgetPwd"],me));
            me.getBackSure.click($.proxy(me["showGetBackPwdSuccess"],me));
            me.buyNowBtn.click($.proxy(me["buyNow"],me));
            me.pwdLoginBtn.click($.proxy(me["pwdLoginNow"],me));
            me.codeLoginBtn.click($.proxy(me["codeLoginNow"],me));
            me.cardId.blur($.proxy(me["verifyCardId"],me));
            me.mobile.blur($.proxy(me["verifyMobile"],me));
            me.pwd.blur($.proxy(me["verifyPwd"],me));
            me.code.blur($.proxy(me["verifyCode"],me));
            me.userName.blur($.proxy(me["verifyName"],me));
            me.navIcon.click($.proxy(me["showMobileNav"],me));
        },
        chooseMoney:function(e){
            var me = this;
            var el = $(e.target);
            if(!el.hasClass("active")){
                me.chooseMon.removeClass("active");
                el.addClass("active");
            }else{
                me.chooseMon.removeClass("active");
            }
            me.inputMoney.val(el.data("val"));
            //me.lastMoney.val(el.data("val"));
        },
        inputMoneyChange:function(){
            var me = this;
            var val = me.inputMoney.val().replace(/[^\d+]/g,"");
            me.inputMoney.val(val);
            me.lastMoney.val(val);
            if($('.priceNum').html().indexOf('¥')>=0){
                if(parseInt(val)<50 || parseInt(val)>8000){
                    // me.inputMoneyTip.show();
                    return false;
                }else{
                    // me.inputMoneyTip.hide();
                }
            }else{
                if(parseInt(val)<50 || parseInt(val)>8000){
                    // me.inputMoneyTip.show();
                    return false;
                }else{
                    // me.inputMoneyTip.hide();
                }
            }
            
            me.chooseMon.removeClass("active");
        },
        closePopup:function(e){
            var me = this;
            var parent = $(e.target).parent().parent();
            parent.hide();
            me.mask.hide();
        },
        showRegister:function(){
            var me = this;
            me.allPopup.hide();
            me.navList.hide();
            me.mask.show();
            me.register.show();
        },
        showRegisterSuccess:function(){
            var me = this;
            var verifyBtn = true;
            //表单验证
            me.registerForm.blur();
            me.registerFormTips.each(function(){
                if($(this).html()!=""){
                    verifyBtn = false;
                }
            });
            if(!verifyBtn) return false;
            me.mask.show();
            // me.registerSuccess.show();
            //me.register.find("form").submit();
            var form  = me.register.find("form");
            var sendCode = {};
            $.each(form.serializeArray(),function(i,d){
                sendCode[d.name] = $.trim(d.value);
            });
            $.ajaxF({
                url:form.attr('action'),
                data:sendCode,
                success:function(data){
                    me.allPopup.hide();
                    me.mask.hide();
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
        },
        showPwdLogin:function(){
            var me = this;
            me.allPopup.hide();
            me.navList.hide();
            me.mask.show();
            me.pwdLogin.show();
        },
        showCodeLogin:function(){
            var me = this;
            me.allPopup.hide();
            me.mask.show();
            me.codeLogin.show();
        },
        showForgetPwd:function(){
            var me = this;
            me.allPopup.hide();
            me.mask.show();
            me.getBackPwd.show();
        },
        showGetBackPwdSuccess:function(){
            var me = this;
            var verifyBtn = true;
            //表单验证
            me.getBackPwdForm.blur();
            me.getBackPwdFormTips.each(function(){
                if($(this).html()!=""){
                    verifyBtn = false;
                }
            });
            if(!verifyBtn) return false;
            me.allPopup.hide();
            me.mask.show();
            me.getBackPwdSuccess.show();
            me.getBackPwd.find("form").submit();
        },
        buyNow:function(){
            var me = this;
            var val = me.inputMoney.val();
            if($('.priceNum').html().indexOf('¥')>=0){
                if(val=="" || val > 50000 || val < 500){//
                    me.inputMoneyChange();
                }else{
                    
                    $(".goodsForm").submit();
                }
            }else{
                if(val=="" || val > 8000 || val < 50){//
                    me.inputMoneyChange();
                }else{
                   
                    $(".goodsForm").submit();
                }
            }
            
        },
        pwdLoginNow:function(){
            var me = this;
            var verifyBtn = true;
            //表单验证
            me.pwdLoginForm.blur();
            me.pwdLoginFormTips.each(function(){
                if($(this).html()!=""){
                    verifyBtn = false;
                }
            });
            if(!verifyBtn) return false;
            //进行密码登录操作
            me.pwdLogin.find("form").submit();
        },
        codeLoginNow:function(){
            var me = this;
            var verifyBtn = true;
            //表单验证
            me.codeLoginForm.blur();
            me.codeLoginFormTips.each(function(){
                if($(this).html()!=""){
                    verifyBtn = false;
                }
            });
            if(!verifyBtn) return false;
            //进行验证码登录操作
            me.codeLogin.find("form").submit();
        },
        showMobileNav:function(){
            var me = this;
            if(me.navList.is(":hidden")){
                me.navList.show();
            }else{
                me.navList.hide();
            }
        },
        countDown:function(e){
            var me = this;
            var el = $(e.target);
			var thisMobile = el.parents("form").find(".mobile");
            if(!el.hasClass("active")){
                return;
            }
			thisMobile.blur();
			if(thisMobile.next(".tips").html()!="") return;
            me.countTime = 60;
            el.removeClass("active");
            me.interval = setInterval(function(){
                me.countTime--;
                if(me.countTime<1){
                    clearInterval(me.interval);
                    me.interval = null;
                    el.html("获取验证码");
                    el.addClass("active");
                }else{
                    el.html(me.countTime);
                }
            },1000);
			var mobile = thisMobile.val();
			var type_id = el.attr("typeId");
			$.ajax({
				type: "post",
				url: "user.php",
				data: { "op": "send_sms", "type_id": type_id, "mobile": mobile },
				dataType: "json",
				success: function (data) {
					alert(data.Message);
				}
			});
        },
        verifyCardId:function(e){
            var me = this;
            var el = $(e.target);
            var elTip = $(e.target).next(".tips");
            var regExp15 = /^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}$/;
            var regExp18 = /^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/;
            var val = el.val();
            var nowTime = new Date().getTime();
            if(val.length==15){
                if(regExp15.test(val)){
                    var birthday = '19'+val.substring(6,8)+'-'+val.substring(8,10)+'-'+val.substring(10,12);
                    var birthTime = new Date(birthday).getTime();
                }else{
                    elTip.html("请输入正确的身份证号码");
                    return;
                }
            }else if(val.length==18){
                if(regExp18.test(val)){
                    var birthday = val.substring(6,10)+'-'+val.substring(10,12)+'-'+val.substring(12,14);
                    var birthTime = new Date(birthday).getTime();
                }else{
                    elTip.html("请输入正确的身份证号码");
                    return;
                }
            }else{
                elTip.html("请输入正确的身份证号码");
                return;
            }
            if((nowTime-birthTime)/(1000*3600*24*365)<18){
                elTip.html("您尚未满18周岁，根据法律规定，不能在本平台开立账户。");
                return;
            }else{
                elTip.html("");
                return;
            }
        },
        verifyMobile:function(e){
            var me = this;
            var el = $(e.target);
            var elTip = $(e.target).next(".tips");
            var regExp = /^1([358][0-9]|4[579]|66|7[0135678]|9[89])[0-9]{8}$/;
            var val = el.val();
            if(regExp.test(val)){
                elTip.html("");
            }else{
                elTip.html("请输入正确的手机号");
            }
        },
        verifyPwd:function(e){
            var me = this;
            var el = $(e.target);
            var elTip = $(e.target).next(".tips");
            var regExp = /^[a-zA-Z0-9]{6,12}$/;
            var val = el.val();
            if(regExp.test(val)){
                elTip.html("");
            }else{
                elTip.html("请输入6-12位的字母或数字");
            }
        },
        verifyName:function(e){
            var me = this;
            var el = $(e.target);
            var elTip = $(e.target).next(".tips");
            var regExp = /^[a-zA-Z\u4e00-\u9fa5]+$/;
            var val = el.val();
            if(regExp.test(val)&&val.length<11){
                elTip.html("");
            }else{
                elTip.html("请输入字符长度不超过10的汉字或字母");
            }
        },
        verifyCode:function(e){
            var me = this;
            var el = $(e.target);
            var elTip = $(e.target).parent(".verify").next(".tips");
            var regExp = /^\d{6}$/;
            var val = parseInt(el.val());
            if(regExp.test(val)){
                elTip.html("");
            }else{
                elTip.html("请输入正确的验证码");
            }
        }
    }
    buyGoods.init();
})(jQuery,window)