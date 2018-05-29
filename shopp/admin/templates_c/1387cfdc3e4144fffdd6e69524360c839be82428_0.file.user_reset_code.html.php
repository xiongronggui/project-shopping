<?php
/* Smarty version 3.1.30, created on 2018-03-29 23:40:46
  from "/u01/nginx/html/fic.sxgcsy.top/admin/templates/user_reset_code.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5abd08fe1ac753_52776246',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1387cfdc3e4144fffdd6e69524360c839be82428' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/admin/templates/user_reset_code.html',
      1 => 1522304418,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5abd08fe1ac753_52776246 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			用户验证码更新
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="user_reset_code.php?op=reset" method="post">
				<div class="linkbox">
					<div>
						<span class="tit">手机号：</span>
						<input type="text" name="mobile" placeholder="输入内容" required="required" />
					</div>
					<div>
						<span class="tit">短信类型：</span>
						<div class="checkBox" style="margin: 0;line-height:40px;">
							<div style="padding-left: 10px;width: inherit;left: 0;">
								<label><input type="radio" name="type_id" value="0">&nbsp;登录验证</label>
								<label><input type="radio" name="type_id" value="1">&nbsp;注册验证</label>
								<label><input type="radio" name="type_id" value="2">&nbsp;变更验证</label>
								<label><input type="radio" name="type_id" value="3" checked>&nbsp;兑换验证</label>
							</div>
						</div>
					</div>
					<div>
						<button type="submit" class="btn" id="submit" style="margin-left: 30%">提交</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html><?php }
}
