<?php
/* Smarty version 3.1.30, created on 2018-03-15 16:50:41
  from "/u01/nginx/html/fic.cuilvshop.com/admin/templates/admin_add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aaa33e1887190_71492899',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3ed3d84430dc97b441e30f6f2c68f0c34432106' => 
    array (
      0 => '/u01/nginx/html/fic.cuilvshop.com/admin/templates/admin_add.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5aaa33e1887190_71492899 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			管理员添加
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="admin.php?op=save&t=add" method="post">
				<div class="linkbox">
					<div>
						<span class="tit">用户名：</span>
						<input type="text" name="username" placeholder="输入内容" required="required" />
					</div>
					<div>
						<span class="tit">密码：</span>
						<input type="password" name="password" placeholder="输入内容" required="required" />
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
"><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['group'];?>
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
						<input type="text" name="realname" placeholder="输入内容" required="required" />
					</div>
					<div>
						<span class="tit">状态：</span>
						<div class="checkBox" style="margin: 0;line-height:40px;">
							<div style="padding-left: 10px;width: inherit;left: 0;">
								<label><input type="radio" name="status" value="0" checked>&nbsp;正常</label>
								<label><input type="radio" name="status" value="1">&nbsp;停用</label>
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
