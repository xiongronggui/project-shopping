<?php
/* Smarty version 3.1.30, created on 2018-03-31 09:42:24
  from "/u01/nginx/html/fic.sxgcsy.top/admin/templates/goods_update.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5abee780b96058_24219423',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcff058a0f9f4cedf6084472ef5b2601b7b12b2e' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/admin/templates/goods_update.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5abee780b96058_24219423 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
	<?php echo '<script'; ?>
 src="js/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/datetimepicker.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		var editor;
		KindEditor.ready(function(K) {
			K.create('textarea[name="content"]', {
				urlType:'domain',
				allowFileManager : true
			});
		});
	<?php echo '</script'; ?>
>
	<div class="main-content">
		<div class="breadcrumbs">
			商品修改
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="goods.php?op=save&t=update" method="post" enctype="multipart/form-data">
				<div class="linkbox">
					<input type="hidden" name="id"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
" />
					<div>
						<span class="tit">商品名称：</span>
						<input type="text" name="title" placeholder="输入内容" required="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['title'];?>
" />
					</div>
					<div style="align-items: flex-start;">
						<span class="tit">商品售价类型：</span>
						<div class="select_check">
							<div>
								<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
								<label><input type="checkbox" name="tid[]" value="<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['price'];?>
" <?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['checked'];?>
 />&nbsp;<?php echo $_smarty_tpl->tpl_vars['result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['type'];?>
&nbsp;&nbsp;&nbsp;&nbsp;</label>	
								<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
							</div>
						</div>
					</div>
					<div style="margin-bottom: 150px;">
						<span class="tit">封面图：</span>
						<input type="file" name="images" class="upload1" placeholder="输入内容" id="img" onchange="preImg(this.id)"/>
						<input type="text" style="width: 42.5%;" placeholder="输入内容" />
						<button class="yellow-btn">添加</button>
						<span style="color:red;"> (上传图片尺寸必须为 420 * 420 px!) </span>
						<?php echo $_smarty_tpl->tpl_vars['info']->value['images_show'];?>

					</div>
					<div>
						<span class="tit">商品内容：</span>
						<textarea name="content" cols="30" rows="4" placeholder="输入内容"><?php echo $_smarty_tpl->tpl_vars['info']->value['content'];?>
</textarea>
					</div>
					<div>
						<span class="tit">状态：</span>
						<div class="checkBox" style="margin: 0;line-height:40px;">
							<div style="padding-left: 10px;width: inherit;left: 0;">
								<label><input type="radio" name="status" value="0"  <?php if ($_smarty_tpl->tpl_vars['info']->value['status'] == 0) {?>checked<?php }?>>&nbsp;正常</label>
								<label><input type="radio" name="status" value="1"  <?php if ($_smarty_tpl->tpl_vars['info']->value['status'] == 1) {?>checked<?php }?>>&nbsp;停用</label>
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
