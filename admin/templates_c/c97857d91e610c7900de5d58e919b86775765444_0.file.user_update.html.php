<?php
/* Smarty version 3.1.30, created on 2018-03-01 17:43:20
  from "/u01/nginx/html/cuilvshop/shop/admin/templates/user_update.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a97cb380f3bc6_86029906',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c97857d91e610c7900de5d58e919b86775765444' => 
    array (
      0 => '/u01/nginx/html/cuilvshop/shop/admin/templates/user_update.html',
      1 => 1518598730,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5a97cb380f3bc6_86029906 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			用户修改
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="user.php?op=save&t=update" method="post">
				<div class="linkbox">
					<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
" />
					<div>
						<span class="tit">手机号：</span>
						<?php echo $_smarty_tpl->tpl_vars['info']->value['mobile'];?>

					</div>
					<div>
						<span class="tit">真实姓名：</span>
						<input type="text" name="realname" placeholder="输入内容" required="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['realname'];?>
" />
					</div>
					<div>
						<span class="tit">身份证号：</span>
						<input type="text" name="people_id" placeholder="输入内容" required="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['people_id'];?>
" />
					</div>
					<div>
						<span class="tit">状态：</span>
						<div class="checkBox" style="margin: 0;line-height:40px;">
							<div style="padding-left: 10px;width: inherit;left: 0;">
								<label><input type="radio" name="status" value="0" <?php if ($_smarty_tpl->tpl_vars['info']->value['status'] == 0) {?>checked<?php }?>>&nbsp;正常</label>
								<label><input type="radio" name="status" value="1" <?php if ($_smarty_tpl->tpl_vars['info']->value['status'] == 1) {?>checked<?php }?>>&nbsp;停用</label>
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
