<?php
defined('IN_DESTOON') or exit('Access Denied');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo DT_CHARSET;?>"/>
<title>管理中心 - <?php echo $DT['sitename']; ?> - Powered By Destoon B2B V<?php echo DT_VERSION; ?> R<?php echo DT_RELEASE;?></title>
<meta name="generator" content="Destoon B2B,www.destoon.com"/>
<link rel="stylesheet" href="admin/image/style.css" type="text/css"/>
<?php if(!DT_DEBUG) { ?><script type="text/javascript">window.onerror= function(){return true;}</script><?php } ?>
<script type="text/javascript" src="lang/<?php echo DT_LANG;?>/lang.js"></script>
<script type="text/javascript" src="file/script/config.js"></script>
<script type="text/javascript" src="file/script/common.js"></script>
</head>
<body>
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr>
<td class="side" title="点击关闭/打开侧栏" onclick="s();">
<div id="side" class="side_on">&nbsp;</div>
</td>
</tr>
</table>
<script type="text/javascript">
function s() {
	if(Dd('side').className == 'side_on') {
		Dd('side').className = 'side_off';
		top.document.getElementsByName("fra")[0].cols = '0,7,*';
	} else {
		Dd('side').className = 'side_on';
		top.document.getElementsByName("fra")[0].cols = '<?php echo $DT['admin_left'];?>,7,*';
	}
}
</script>
<?php if($_admin == 1 && !is_file(DT_ROOT.'/file/md5/'.DT_VERSION.'.php')) { ?>
<script type="text/javascript" src="?file=md5&action=add&js=1"></script>
<?php } ?>
</body>
</html>