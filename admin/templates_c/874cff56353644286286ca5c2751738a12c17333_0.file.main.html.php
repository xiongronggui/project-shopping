<?php
/* Smarty version 3.1.30, created on 2018-04-20 10:22:59
  from "E:\phpStudy\WWW\openepay\fic.xs9999\admin\templates\main.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ad94f037d3943_28922331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '874cff56353644286286ca5c2751738a12c17333' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\admin\\templates\\main.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5ad94f037d3943_28922331 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			账号信息
		</div>
		<div class="page-content">
			<?php echo $_SESSION['admin']['info']['realname'];?>
，欢迎您！
		</div>
	</div>
</div>
</body>
</html>

<?php }
}
