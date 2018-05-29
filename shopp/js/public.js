/*设置在iphone5下html字体为100px*/
;(function($, doc, win) {
    var docEl = doc.documentElement,
        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
        recalc = function() {
            var clientWidth = docEl.clientWidth;
            if (!clientWidth) return;
			clientWidth =  Math.min(450, clientWidth); //增加最大页面
            docEl.style.fontSize = (clientWidth / 3.75) + 'px';
        };
    if (!doc.addEventListener) return;
    win.addEventListener(resizeEvt, recalc, false);
    doc.addEventListener('DOMContentLoaded', recalc, false);
    //移动端返回按钮
    $(".goback").click(function() {
        var ref = doc.referrer;
        if (ref != "" && ref != "undefined") {
            win.location.href = history.back(-1);
        } else {
            win.location.href = "goods.php";
        }
    });
    //移动端返回首页按钮
    $(".gohome").click(function() {
        win.location.href = "goods.php";
    });
})(jQuery, document, window);

;(function($){
	// 通用方法
	$.fn.transitionEnd = function(callback) {
        var events = ['webkitTransitionEnd', 'transitionend', 'oTransitionEnd', 'MSTransitionEnd', 'msTransitionEnd'],
            i, dom = this;

        function fireCallBack(e) {
            /*jshint validthis:true */
            if (e.target !== this) return;
            callback.call(this, e);
            for (i = 0; i < events.length; i++) {
                dom.off(events[i], fireCallBack);
            }
        }
        if (callback) {
            for (i = 0; i < events.length; i++) {
                dom.on(events[i], fireCallBack);
            }
        }
        return this;
    };
	$.fn.dataset = function() {
        var el = this[0];
        if (el) {
            var dataset = {};
            if (el.dataset) {

                for (var dataKey in el.dataset) { // jshint ignore:line
                    dataset[dataKey] = el.dataset[dataKey];
                }
            } else {
                for (var i = 0; i < el.attributes.length; i++) {
                    var attr = el.attributes[i];
                    if (attr.name.indexOf('data-') >= 0) {
                        dataset[$.toCamelCase(attr.name.split('data-')[1])] = attr.value;
                    }
                }
            }
            for (var key in dataset) {
                if (dataset[key] === 'false') dataset[key] = false;
                else if (dataset[key] === 'true') dataset[key] = true;
                else if (parseFloat(dataset[key]) === dataset[key] * 1) dataset[key] = dataset[key] * 1;
            }
            return dataset;
        } else return undefined;
    };
})(jQuery);

//弹窗
;(function($) {
    var _modalTemplateTempDiv = document.createElement('div');

    $.modalStack = [];

    $.modalStackClearQueue = function() {
        if ($.modalStack.length) {
            ($.modalStack.shift())();
        }
    };
    $.modal = function(params) {
        params = params || {};
        var modalHTML = '';
        var buttonsHTML = '';
        if (params.buttons && params.buttons.length > 0) {
            for (var i = 0; i < params.buttons.length; i++) {
                buttonsHTML += '<span class="modal-button' + (params.buttons[i].bold ? ' modal-button-bold' : '') + '' + (params.buttons[i].cssClass ? ' ' + params.buttons[i].cssClass : '') + '">' + params.buttons[i].text + '</span>';
            }
        }
        var extraClass = params.cssClass || '';
        var titleHTML = params.title ? '<div class="modal-title">' + params.title + '</div>' : '';
        var closeHTML = params.close ? '<div class="modal-close"><a href="javascript:"></a></div>' : '';
        var textHTML = params.text ? '<div class="modal-text"><div class="modal-overflow">' + params.text + '</div></div>' : '';
        var afterTextHTML = params.afterText ? params.afterText : '';
        var noButtons = !params.buttons || params.buttons.length === 0 ? 'modal-no-buttons' : '';
        var verticalButtons = params.verticalButtons ? 'modal-buttons-vertical' : '';
        modalHTML = '<div class="modal ' + extraClass + ' ' + noButtons + '"><div class="modal-inner">' + (closeHTML + titleHTML + textHTML + afterTextHTML) + '</div><div class="modal-buttons ' + verticalButtons + '">' + buttonsHTML + '</div></div>';

        _modalTemplateTempDiv.innerHTML = modalHTML;

        var modal = $(_modalTemplateTempDiv).children();

        $(defaults.modalContainer).append(modal[0]);

        // Add events on buttons
        modal.find('.modal-button').each(function(index, el) {
            $(el).on('click', function(e) {
                if (params.buttons[index].close !== false) $.closeModal(modal);
                if (params.buttons[index].onClick) params.buttons[index].onClick(modal, e);
                if (params.onClick) params.onClick(modal, index);
            });
        });
        //绑定close事件
        if (closeHTML) {
            modal.find('.modal-close a').on('click', function() {
                $.closeModal(modal);
            });
        }
        $.openModal(modal);
        return modal[0];
    };
    $.alert = function(text, title, callbackOk) {
        if (typeof title === 'function') {
            callbackOk = arguments[1];
            title = undefined;
        }
        return $.modal({
            text: text || '',
            title: typeof title === 'undefined' ? defaults.modalTitle : title,
            buttons: [{ text: defaults.modalButtonOk, bold: true, onClick: callbackOk, cssClass: 'modal-button-primary' }]
        });
    };
    $.confirm = function(text, title, callbackOk, callbackCancel) {
        if (typeof title === 'function') {
            callbackCancel = arguments[2];
            callbackOk = arguments[1];
            title = undefined;
        }
        return $.modal({
            text: text || '',
            title: typeof title === 'undefined' ? defaults.modalTitle : title,
            buttons: [
                { text: defaults.modalButtonCancel, onClick: callbackCancel },
                { text: defaults.modalButtonOk, bold: true, onClick: callbackOk, cssClass: 'modal-button-primary' }
            ]
        });
    };

    $.showIndicator = function() {
        if ($('.preloader-indicator-modal')[0]) return;
        $(defaults.modalContainer).append('<div class="preloader-indicator-overlay"></div><div class="preloader-indicator-modal"><span class="preloader preloader-white"></span></div>');
    };
    $.hideIndicator = function() {
        $('.preloader-indicator-overlay, .preloader-indicator-modal').remove();
    };

    //显示一个消息，会在2秒钟后自动消失
    $.toast = function(msg, duration, extraclass) {
        var $toast = $('<div class="modal toast ' + (extraclass || '') + '">' + msg + '</div>').appendTo(document.body);
        $.openModal($toast, function() {
            setTimeout(function() {
                $.closeModal($toast);
            }, duration || 2000);
        });
        return $toast;
    };
    $.openModal = function(modal, cb) {
        modal = $(modal);
        var isModal = modal.hasClass('modal'),
            isNotToast = !modal.hasClass('toast');
        var isPopup = modal.hasClass('popup');
        var isLoginScreen = modal.hasClass('login-screen');
        var isPickerModal = modal.hasClass('picker-modal');
        var isToast = modal.hasClass('toast');
        if (isModal) {
            modal.show();
            modal.css({
				marginTop: -Math.round(modal.outerHeight() / 2) + 'px'
			});
        }
        if (isToast) {
            modal.css({
                marginLeft: -Math.round(modal.outerWidth() / 2) + 'px'
            });
        }

        var overlay;
        if (!isLoginScreen && !isPickerModal && !isToast) {
            if ($('.modal-overlay').length === 0 && !isPopup) {
                $(defaults.modalContainer).append('<div class="modal-overlay"></div>');
            }
            if ($('.popup-overlay').length === 0 && isPopup) {
                $(defaults.modalContainer).append('<div class="popup-overlay"></div>');
            }
            overlay = isPopup ? $('.popup-overlay') : $('.modal-overlay');
        }

        //Make sure that styles are applied, trigger relayout;
        var clientLeft = modal[0].clientLeft;

        // Trugger open event
        modal.trigger('open');

        // Picker modal body class
        if (isPickerModal) {
            $(defaults.modalContainer).addClass('with-picker-modal');
        }

        // Classes for transition in
        if (!isLoginScreen && !isPickerModal && !isToast) overlay.addClass('modal-overlay-visible');
        modal.removeClass('modal-out').addClass('modal-in').transitionEnd(function(e) {
            if (modal.hasClass('modal-out')) modal.trigger('closed');
            else modal.trigger('opened');
        });
        // excute callback
        if (typeof cb === 'function') {
            cb.call(this);
        }
        return true;
    };
    $.closeModal = function(modal) {
        modal = $(modal || '.modal-in');
        if (typeof modal !== 'undefined' && modal.length === 0) {
            return;
        }
        var isModal = modal.hasClass('modal'),
            isPopup = modal.hasClass('popup'),
            isToast = modal.hasClass('toast'),
            isLoginScreen = modal.hasClass('login-screen'),
            isPickerModal = modal.hasClass('picker-modal'),
            removeOnClose = modal.hasClass('remove-on-close'),
            overlay = isPopup ? $('.popup-overlay') : $('.modal-overlay');
        if (isPopup) {
            if (modal.length === $('.popup.modal-in').length) {
                overlay.removeClass('modal-overlay-visible');
            }
        } else if (isModal) {
            if (modal.length === $('.modal.modal-in').length) {
                overlay.removeClass('modal-overlay-visible');
            }
        } else if (!(isPickerModal || isToast)) {
            overlay.removeClass('modal-overlay-visible');
        }

        modal.trigger('close');

        // Picker modal body class
        if (isPickerModal) {
            $(defaults.modalContainer).removeClass('with-picker-modal');
            $(defaults.modalContainer).addClass('picker-modal-closing');
        }

        modal.removeClass('modal-in').addClass('modal-out').transitionEnd(function(e) {
            if (modal.hasClass('modal-out')) modal.trigger('closed');
            else modal.trigger('opened');

            if (isPickerModal) {
                $(defaults.modalContainer).removeClass('picker-modal-closing');
            }
            if (isPopup || isLoginScreen || isPickerModal) {
                modal.removeClass('modal-out').hide();
                if (removeOnClose && modal.length > 0) {
                    modal.remove();
                }
            } else {
                modal.remove();
            }
        });
        if (isModal && defaults.modalStack) {
            $.modalStackClearQueue();
        }

        return true;
    };

    function handleClicks(e) {
        /*jshint validthis:true */
        var clicked = $(this);
        var url = clicked.attr('href');


        //Collect Clicked data- attributes
        var clickedData = clicked.dataset();

        // Popup
        var popup;
        if (clicked.hasClass('open-popup')) {
            if (clickedData.popup) {
                popup = clickedData.popup;
            } else popup = '.popup';
            $.popup(popup);
        }
        if (clicked.hasClass('close-popup')) {
            if (clickedData.popup) {
                popup = clickedData.popup;
            } else popup = '.popup.modal-in';
            $.closeModal(popup);
        }

        // Close Modal
        if (clicked.hasClass('modal-overlay')) {
            if ($('.modal.modal-in').length > 0 && defaults.modalCloseByOutside)
                $.closeModal('.modal.modal-in');
            if ($('.actions-modal.modal-in').length > 0 && defaults.actionsCloseByOutside)
                $.closeModal('.actions-modal.modal-in');

        }
        if (clicked.hasClass('popup-overlay')) {
            if ($('.popup.modal-in').length > 0 && defaults.popupCloseByOutside)
                $.closeModal('.popup.modal-in');
        }
    }
		$(document).on('click', ' .modal-overlay, .popup-overlay, .close-popup, .open-popup, .close-picker', handleClicks);
			var defaults = $.modal.prototype.defaults = {
			modalStack: true,
			modalButtonOk: '确定',
			modalButtonCancel: '取消',
			modalPreloaderTitle: '加载中',
			modalContainer: document.body ? document.body : 'body'
		};
})(jQuery);

;(function($){
	//获取url参数
	$.getParams=function(type){
		var result ={};  
		var params =(window.location.search.split('?')[1] || '').split('&');  
		for(var param in params) {  
			if(params.hasOwnProperty(param)) {  
				paramParts=params[param].split('=');  
				result[paramParts[0]] = decodeURIComponent(paramParts[1] || "");  
			}  
		}
		if(type){
			return result[type];
		}
		return result;
	};
	//简化ajax方法
	$.ajaxF=function(options){
		var defaults={
			type:'post',
            url:window.location.href,
            dataType:'json',
            timeout:8000,
            beforeSend:function(){
                $.showIndicator();
                return true;
            },
            complete: function () {
                $.hideIndicator();
                return true;
            },
            success: function () {
                return true;
            },
            error: function (data) {
                $.hideIndicator();
                $.toast('网络出错，请重试！');
            },
            fail: function () {
                //返回错误回调函数
                return true;
            }
		};
        var callback = {};
        if (typeof options.success == 'function') {
            callback.success = function(data) {
                if (data.success == false) {
                    if (typeof options.fail == 'function') {
                       options.fail(data);
                    } else {
                       $.toast(data.msg); 
                    }
                    return true;
                }
                return options.success(data);          
            }
        }
        return $.ajax($.extend({}, defaults, options,callback));
	};
    // live800
    $.live800 = function(){
        var h = Math.round(($(window).height() - 606) / 2);
        var w = Math.round(($(window).width() - 740) / 2);
        window.open("https://v1.live800.com/live800/chatClient/chatbox.jsp?companyID=966829&configID=44544&jid=8102787173&s=1", "newwindow", "top=" + h + ",left=" + w + ",height=606,width=740,toolbar=no,menubar=no,scrollbars=no,resizable=yes,location=no,status=no");
    }
	
})(jQuery);


/*
* 倒计时方法
*/
; (function () {

    var countdown = function (dom, options) {
        var defaults = {
            time: 60,
            cssClass: 'disabled',
            defaultText: '发送短信验证码',
            text: "{0}秒后重新获取",
            succ: null
        }
        this.dom = $(dom);
        this.is_input = this.dom.is("input"); //判断是否为表单
        this.options = $.extend(true, {}, defaults, options);
        this.init();
    };
    countdown.prototype = {
        init: function () {
            var self = this;
            self.dom.addClass(self.options.cssClass);
            self.options.defaultText = self._text() || self.options.defaultText;
            var run = function () {
                self.options.time--;
                if (self.options.time > 0) {
                    self._text(self.format(self.options.text, self.options.time));
                    setTimeout(run, 1000);
                } else {
                    self.dom.removeClass(self.options.cssClass);
                    self._text(self.options.defaultText);
                    //倒计时回调
                    self.options.succ && self.options.succ.call(self);
                }
            }
            run();
        },
        format: function (str) {
            //格式化
            if (arguments.length <= 1) {
                return str;
            }
            for (var i = 1; i < arguments.length; i++) {
                var re = new RegExp('\\{' + (i - 1) + '\\}', 'gm');
                str = str.replace(re, arguments[i]);
            }
            return str;
        },
        _text: function (value) {
            //判断标签类型再获取或赋值
            var self = this, dom = self.dom;
            if (typeof value === 'undefined') {
                //获取值
                return self.is_input ? dom.val() : dom.text();
            }
            //更新值
            return self.is_input ? dom.val(value) : dom.text(value);
        },
        setTime: function (time) {
            this.options.time = time || 0;
        }
    }
    $.countdown = function (dom, options) {
        return new countdown(dom, options);
    }
    $.fn.countdown = function (option, value) {
        return this.each(function () {
            var $this = $(this);
            var data = $this.data('xs_countdown')
            if (!data || typeof option != 'string') $this.data('xs_countdown', (data = new countdown(this, option)))
            if (typeof option == 'string') data[option](value);
        });
    };
})(jQuery);

;(function(){
	//判断银行卡格式
    $.checkCardNO = function (bankno) {
        var lastNum = bankno.substr(bankno.length - 1, 1);//取出最后一位（与luhn进行比较）

        var first15Num = bankno.substr(0, bankno.length - 1);//前15或18位
        var newArr = new Array();
        for (var i = first15Num.length - 1; i > -1; i--) {    //前15或18位倒序存进数组
            newArr.push(first15Num.substr(i, 1));
        }
        var arrJiShu = new Array();  //奇数位*2的积 <9
        var arrJiShu2 = new Array(); //奇数位*2的积 >9

        var arrOuShu = new Array();  //偶数位数组
        for (var j = 0; j < newArr.length; j++) {
            if ((j + 1) % 2 == 1) {//奇数位
                if (parseInt(newArr[j]) * 2 < 9)
                    arrJiShu.push(parseInt(newArr[j]) * 2);
                else
                    arrJiShu2.push(parseInt(newArr[j]) * 2);
            }
            else //偶数位
                arrOuShu.push(newArr[j]);
        }

        var jishu_child1 = new Array();//奇数位*2 >9 的分割之后的数组个位数
        var jishu_child2 = new Array();//奇数位*2 >9 的分割之后的数组十位数
        for (var h = 0; h < arrJiShu2.length; h++) {
            jishu_child1.push(parseInt(arrJiShu2[h]) % 10);
            jishu_child2.push(parseInt(arrJiShu2[h]) / 10);
        }

        var sumJiShu = 0; //奇数位*2 < 9 的数组之和
        var sumOuShu = 0; //偶数位数组之和
        var sumJiShuChild1 = 0; //奇数位*2 >9 的分割之后的数组个位数之和
        var sumJiShuChild2 = 0; //奇数位*2 >9 的分割之后的数组十位数之和
        var sumTotal = 0;
        for (var m = 0; m < arrJiShu.length; m++) {
            sumJiShu = sumJiShu + parseInt(arrJiShu[m]);
        }

        for (var n = 0; n < arrOuShu.length; n++) {
            sumOuShu = sumOuShu + parseInt(arrOuShu[n]);
        }

        for (var p = 0; p < jishu_child1.length; p++) {
            sumJiShuChild1 = sumJiShuChild1 + parseInt(jishu_child1[p]);
            sumJiShuChild2 = sumJiShuChild2 + parseInt(jishu_child2[p]);
        }
        //计算总和
        sumTotal = parseInt(sumJiShu) + parseInt(sumOuShu) + parseInt(sumJiShuChild1) + parseInt(sumJiShuChild2);

        //计算luhn值
        var k = parseInt(sumTotal) % 10 == 0 ? 10 : parseInt(sumTotal) % 10;
        var luhn = 10 - k;

        if (lastNum == luhn) {
            //验证通过
            return true;
        }
        else {
            //验证不通过
            return false;
        }
    }
	
	//判断是否为有效身份证
    $.checkCardID = function (value) {
        var r_false = {
            IsSuccess: false,
            Message: '您输入的身份证号码有误,请重新输入'
        };
        var aCity = { 11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆" }
        var iSum = 0;
        if (!/^\d{17}(\d|x)$/i.test(value)) {
            return r_false;
        }
        value = value.replace(/x$/i, "a");
        if (aCity[parseInt(value.substr(0, 2))] == null) {
            return r_false;
        }
        sBirthday = value.substr(6, 4) + "-" + Number(value.substr(10, 2)) + "-" + Number(value.substr(12, 2));
        var d = new Date(sBirthday.replace(/-/g, "/"));
        if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate())) {
            return r_false;
        }
        for (var i = 17; i >= 0; i--) {
            iSum += (Math.pow(2, i) % 11) * parseInt(value.charAt(17 - i), 11);
        }
        if (iSum % 11 != 1) {
            return r_false;
        }
        return {
            IsSuccess: true
        };
    }
	
})(jQuery);