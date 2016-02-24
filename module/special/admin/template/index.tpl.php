<?php
defined('IN_DESTOON') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt"><?php echo $MOD['name'];?>搜索</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<?php echo $level_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="条/页"/>
<input type="submit" value="搜 索" class="btn"/>&nbsp;
<input type="button" value="重 置" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
<tr>
<td>
&nbsp;<select name="datetype">
<option value="edittime" <?php if($datetype == 'edittime') echo 'selected';?>>更新日期</option>
<option value="addtime" <?php if($datetype == 'addtime') echo 'selected';?>>发布日期</option>
</select>&nbsp;
<?php echo dcalendar('fromdate', $fromdate, '');?> 至 <?php echo dcalendar('todate', $todate, '');?>&nbsp;
<?php echo $_admin == 1 ? category_select('catid', '不限分类', $catid, $moduleid) : ajax_category_select('catid', '不限分类', $catid, $moduleid);?>&nbsp;
<?php echo $DT['city'] ? ajax_area_select('areaid', '不限地区', $areaid).'&nbsp;' : '';?>
ID：<input type="text" size="4" name="itemid" value="<?php echo $itemid;?>"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt"><?php echo $menus[$menuid][0];?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>

<th>分类</th>
<th width="14"> </th>
<th>封面</th>
<th>标 题</th>
<th>会员</th>
<th width="120"><?php echo $timetype == 'add' ? '添加' : '更新';?>时间</th>
<th>信息</th>
<th>浏览</th>
<th width="100">操作</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>

<td><a href="<?php echo $v['caturl'];?>" target="_blank"><?php echo $v['catname'];?></a></td>
<td><?php if($v['level']) {?><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&level=<?php echo $v['level'];?>"><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>级" alt=""/></a><?php } ?></td>
<td><a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="<?php echo $v['thumb'];?>" width="60" style="padding:5px;"/></a></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['title'];?></a></td>
<td>
<?php if($v['username']) { ?>
<a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a>
<?php } else { ?>
	<a href="javascript:_ip('<?php echo $v['ip'];?>');" title="游客"><?php echo $v['ip'];?></a>
<?php } ?>
</td>
<?php if($timetype == 'add') {?>
<td class="px11" title="更新时间<?php echo $v['editdate'];?>"><?php echo $v['adddate'];?></td>
<?php } else { ?>
<td class="px11" title="添加时间<?php echo $v['adddate'];?>"><?php echo $v['editdate'];?></td>
<?php } ?>
<td class="px11"><a href="?moduleid=<?php echo $moduleid;?>&file=item&specialid=<?php echo $v['itemid'];?>"><?php echo $v['items'];?></a></td>
<td class="px11"><?php echo $v['hits'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=item&action=add&specialid=<?php echo $v['itemid'];?>"><img src="admin/image/add.png" width="16" height="16" title="向此专题位添加信息" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=item&specialid=<?php echo $v['itemid'];?>"><img src="admin/image/child.png" width="16" height="16" title="此专题信息列表" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="修改" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="删除" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">

<?php if($action == 'check') { ?>

<input type="submit" value=" 通过审核 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=check';"/>&nbsp;
<input type="submit" value=" 拒 绝 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=reject';"/>&nbsp;
<input type="submit" value=" 移动分类 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=move';"/>&nbsp;
<input type="submit" value=" 回收站 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&recycle=1';"/>&nbsp;
<input type="submit" value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中<?php echo $MOD['name'];?>吗？此操作将不可撤销')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>

<?php } else if($action == 'reject') { ?>

<input type="submit" value=" 回收站 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&recycle=1';"/>&nbsp;
<input type="submit" value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中<?php echo $MOD['name'];?>吗？此操作将不可撤销')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>

<?php } else if($action == 'recycle') { ?>

<input type="submit" value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中<?php echo $MOD['name'];?>吗？此操作将不可撤销')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" 还 原 " class="btn" onclick="if(confirm('确定要还原选中<?php echo $MOD['name'];?>吗？状态将被设置为已通过')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=restore'}else{return false;}"/>&nbsp;
<input type="submit" value=" 清 空 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=clear';"/>

<?php } else { ?>

<input type="submit" value=" 更新信息 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=update';"/>&nbsp;
<input type="submit" value=" 生成网页 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=tohtml';"/>&nbsp;
<input type="submit" value=" 回收站 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&recycle=1';"/>&nbsp;
<input type="submit" value=" 彻底删除 " class="btn" onclick="if(confirm('确定要删除选中<?php echo $MOD['name'];?>吗？此操作将不可撤销')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" 移动分类 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=move';"/>&nbsp;
<input type="submit" value=" 一键生成 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=html&action=all';" title="生成该模块所有网页"/>&nbsp;
<input type="submit" value=" 更新所有 " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=html&action=show&update=1';" title="更新该模块所有信息地址等项目"/>&nbsp;
<?php echo level_select('level', '设置级别为</option><option value="0">取消', 0, 'onchange="this.form.action=\'?moduleid='.$moduleid.'&file='.$file.'&action=level\';this.form.submit();"');?>

<?php } ?>

</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>