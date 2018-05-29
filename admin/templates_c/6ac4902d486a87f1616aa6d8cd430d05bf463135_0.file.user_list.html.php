<?php
/* Smarty version 3.1.30, created on 2018-03-01 17:19:11
  from "/u01/nginx/html/cuilvshop/shop/admin/templates/user_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a97c58f2b2164_56159994',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ac4902d486a87f1616aa6d8cd430d05bf463135' => 
    array (
      0 => '/u01/nginx/html/cuilvshop/shop/admin/templates/user_list.html',
      1 => 1519895614,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5a97c58f2b2164_56159994 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<?php echo '<script'; ?>
 src="js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
	<div class="main-content">
		<div class="breadcrumbs">
			用户列表
		</div>
		<div class="page-content">
			<div class="retrieval">
				<div class="tablebox">
					<table class="display" cellpadding="0" cellspacing="0" border="0" id="news">
						<thead>
							<tr>
								<th>ID</th>
								<th>手机号</th>
								<th>姓名</th>
								<th>性别</th>
								<th>身份证号</th>
								<th>注册时间</th>
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
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['mobile'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['realname'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['gender'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['people_id'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['addtime_show'];?>
</td>
								<td><a href="user.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=save&t=status" onclick="return confirm('您确定要改变该用户状态吗？');"><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['status_show'];?>
</a></td>
								<td>
									<div>
										<a href="user.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=update">
											<i class="icon-pen" title="修改"></i>
										</a>
										<a href="user.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=save&t=reset" onclick="return confirm('您确定要重置该用户的密码吗？');">
											<i class="icon-password" title="密码重置"></i>
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
