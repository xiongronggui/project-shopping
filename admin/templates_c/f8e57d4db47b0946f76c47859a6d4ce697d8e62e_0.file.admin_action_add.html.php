<?php
/* Smarty version 3.1.30, created on 2018-04-20 10:23:51
  from "E:\phpStudy\WWW\openepay\fic.xs9999\admin\templates\admin_action_add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ad94f37b338f6_56907044',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8e57d4db47b0946f76c47859a6d4ce697d8e62e' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\admin\\templates\\admin_action_add.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5ad94f37b338f6_56907044 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			权限添加
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="admin_action.php?op=save&t=add" method="post">
				<div class="linkbox">
					<div>
						<span class="tit">父节点：</span>
						<select name="fid" class="select-long">
							<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['title'];?>
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
						<span class="tit">权限标题：</span>
						<input type="text" name="title" placeholder="输入内容" required="required" />
					</div>
					<div>
						<span class="tit">权限URL：</span>
						<input type="text" name="url" placeholder="输入内容" />
					</div>
					<div>
						<span class="tit">排序权重(越大越靠前)：</span>
						<select name="index" class="select-long">
							<?php
$__section_show_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['results']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_1_total = $__section_show_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_1_total != 0) {
for ($__section_show_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_1_iteration <= $__section_show_1_total; $__section_show_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)];?>
"><?php echo $_smarty_tpl->tpl_vars['results']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)];?>
</option>
							<?php
}
}
if ($__section_show_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_1_saved;
}
?>
						</select>
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
