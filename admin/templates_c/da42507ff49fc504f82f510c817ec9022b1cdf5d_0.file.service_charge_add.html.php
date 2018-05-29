<?php
/* Smarty version 3.1.30, created on 2018-04-20 15:13:16
  from "E:\phpStudy\WWW\openepay\fic.xs9999\admin\templates\service_charge_add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ad9930c6d0893_57788667',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da42507ff49fc504f82f510c817ec9022b1cdf5d' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\admin\\templates\\service_charge_add.html',
      1 => 1524208389,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5ad9930c6d0893_57788667 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			手续费管理
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="service_charge_list.php?op=save" method="post">
				<div class="linkbox">
					<div>
						<input type="hidden" name="charge_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
						<span class="tit">通道名称：</span>
						<input type="text" name="charge_name" placeholder="输入通道名称" required="required" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" />
					</div>
					<div>
						<span class="tit">手续费：</span>
						<input type="text" name="charge_val" placeholder="输入手续费" required="required" value="<?php echo $_smarty_tpl->tpl_vars['rate']->value;?>
" />
					</div>
					<div>
						<span class="tit">计算方式：</span>
						<select name="charge_type" class="select-long" style="width: 769px;">
							<option value="1">四舍五入</option>
							<option value="2">向下取整</option>
							<option value="3">向上取整</option>
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
