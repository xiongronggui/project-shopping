<?php
/* Smarty version 3.1.30, created on 2018-03-26 12:25:02
  from "/u01/nginx/html/fic.sxgcsy.top/admin/templates/main.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ab8761e17d976_98516400',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c619ae9e33689e36b4e42c2deb1d5b0d5ff85b13' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/admin/templates/main.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5ab8761e17d976_98516400 (Smarty_Internal_Template $_smarty_tpl) {
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
