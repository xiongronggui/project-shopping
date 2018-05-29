<?php
/* Smarty version 3.1.30, created on 2018-03-15 15:55:00
  from "/u01/nginx/html/cuilvshop/shop/admin/templates/goods_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aaa26d4c8abc6_16367558',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e67e84e3e754a754d46362323041d73d25b5220' => 
    array (
      0 => '/u01/nginx/html/cuilvshop/shop/admin/templates/goods_list.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5aaa26d4c8abc6_16367558 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<link rel="stylesheet" href="css/jquery.dataTables.css">
	<?php echo '<script'; ?>
 src="js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
	<div class="main-content">
		<div class="breadcrumbs">
			商品列表
		</div>
		<div class="page-content">
			<div class="retrieval">
				<button class="btn new-btn" onclick="window.location.href='goods.php?op=add';">商品添加</button>
				<div class="tablebox">
					<table class="display" cellpadding="0" cellspacing="0" border="0" id="news">
						<thead>
							<tr>
								<th>ID</th>
								<th>商品名称</th>
								<th>售价</th>
								<th>封面图</th>
								<th>操作员</th>
								<th>修改时间</th>
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
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['title'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['sell_type'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['images_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['realname'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['mtime_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['status_show'];?>
</td>
								<td>
									<div>
										<a href="goods.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=update">
											<i class="icon-pen" title="修改"></i>
										</a>
										<!--<a href="goods.php?id=<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['id'];?>
&op=del" onclick="return confirm('您确定要删除该商品吗？');">
											<i class="icon-delete" title="删除"></i>
										</a>-->
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
