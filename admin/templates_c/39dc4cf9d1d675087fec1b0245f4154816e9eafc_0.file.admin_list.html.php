<?php
/* Smarty version 3.1.30, created on 2018-03-15 15:42:51
  from "/u01/nginx/html/fic.cuilvshop.com/admin/templates/admin_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aaa23fb7c5383_14761393',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '39dc4cf9d1d675087fec1b0245f4154816e9eafc' => 
    array (
      0 => '/u01/nginx/html/fic.cuilvshop.com/admin/templates/admin_list.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5aaa23fb7c5383_14761393 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<?php echo '<script'; ?>
 src="js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
	<div class="main-content">
		<div class="breadcrumbs">
			管理员用户列表
		</div>
		<div class="page-content">
			<div class="retrieval">
				<button class="btn new-btn" onclick="window.location.href='admin.php?op=add';">用户添加</button>
				<div class="tablebox">
					<table class="display" cellpadding="0" cellspacing="0" border="0" id="news">
						<thead>
							<tr>
								<th>ID</th>
								<th>用户名称</th>
								<th>用户账号</th>
								<th>角色组</th>
								<th>添加时间</th>
								<th>状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
							<tr>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['realname'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['username'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['group'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['addtime'];?>
</td>
								<td><a href="admin.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=save&t=status" onclick="return confirm('您确定要改变该用户状态吗？');"><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['status'];?>
</a></td>
								<td>
									<div>
										<a href="admin.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=update">
											<i class="icon-pen" title="修改"></i>
										</a>
										<a href="admin.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=save&t=reset" onclick="return confirm('您确定要重置该用户的密码吗？');">
											<i class="icon-password" title="密码重置"></i>
										</a>
										<a href="admin.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=del" onclick="return confirm('您确定要删除该用户吗？');">
											<i class="icon-delete" title="删除"></i>
										</a>
									</div>
								</td>
							</tr>
							<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html><?php }
}
