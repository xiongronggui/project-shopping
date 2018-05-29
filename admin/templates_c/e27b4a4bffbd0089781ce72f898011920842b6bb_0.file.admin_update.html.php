<?php
/* Smarty version 3.1.30, created on 2018-03-02 09:20:34
  from "/u01/nginx/html/cuilvshop/shop/admin/templates/admin_update.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a98a6e2454e83_72998677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e27b4a4bffbd0089781ce72f898011920842b6bb' => 
    array (
      0 => '/u01/nginx/html/cuilvshop/shop/admin/templates/admin_update.html',
      1 => 1518591976,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5a98a6e2454e83_72998677 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			管理员用户修改
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="admin.php?op=save&t=update" method="post">
				<div class="linkbox">
					<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
" />
					<div>
						<span class="tit">用户名：</span>
						<?php echo $_smarty_tpl->tpl_vars['info']->value['username'];?>

					</div>
					<div>
						<span class="tit">密码：</span>
						<input type="password" name="password" placeholder="输入内容" />
					</div>
					<div>
						<span class="tit">角色组：</span>
						<select name="group_id" class="select-long">
							<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'] == $_smarty_tpl->tpl_vars['info']->value['group_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['group'];?>
</option>
							<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
						</select>
					</div>
					<div>
						<span class="tit">真实姓名：</span>
						<input type="text" name="realname" placeholder="输入内容" required="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['realname'];?>
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
