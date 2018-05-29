<?php
/* Smarty version 3.1.30, created on 2018-03-15 16:49:01
  from "/u01/nginx/html/fic.cuilvshop.com/admin/templates/admin_group_add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aaa337d4ea5c1_10245250',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '58cefebd18274664de9a7ffd3bf7f8b3b8875fee' => 
    array (
      0 => '/u01/nginx/html/fic.cuilvshop.com/admin/templates/admin_group_add.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5aaa337d4ea5c1_10245250 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			管理员用户组添加
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="admin_group.php?op=save&t=add" method="post">
				<div class="linkbox">
					<div>
						<span class="tit">用户组名称：</span>
						<input type="text" name="group" placeholder="输入内容" required="required" />
					</div>
					<div style="align-items: flex-start;">
						<span class="tit">权限管理：</span>
						<div class="select_check">
							<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
								<div class="checkBox">
								<span><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['title'];?>
</span>
								<div>
									<?php
$__section_shows_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_shows']) ? $_smarty_tpl->tpl_vars['__smarty_section_shows'] : false;
$__section_shows_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son']) ? count($_loop) : max(0, (int) $_loop));
$__section_shows_1_total = $__section_shows_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_shows'] = new Smarty_Variable(array());
if ($__section_shows_1_total != 0) {
for ($__section_shows_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_shows']->value['index'] = 0; $__section_shows_1_iteration <= $__section_shows_1_total; $__section_shows_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_shows']->value['index']++){
?>
									<label><input type="checkbox" name="action[]" value="<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son'][(isset($_smarty_tpl->tpl_vars['__smarty_section_shows']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shows']->value['index'] : null)]['id'];?>
" />&nbsp;<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son'][(isset($_smarty_tpl->tpl_vars['__smarty_section_shows']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_shows']->value['index'] : null)]['title'];?>
</label>								
									<?php
}
}
if ($__section_shows_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_shows'] = $__section_shows_1_saved;
}
?>
								</div>
							</div>
							<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
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
