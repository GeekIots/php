<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if($_G['uid']) { ?>
<div id="um">
<p>	
<a href="home.php?mod=spacecp&amp;ac=usergroup" class="t9_icon t9_group"><?php echo $_G['group']['grouptitle'];?><?php if($_G['member']['freeze']) { ?><span class="xi1">(已冻结)</span><?php } ?></a>
<a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>" target="_blank" title="访问我的空间" class="t9_icon t9_space">个人空间</a>
<a href="javascript:;" id="myitem" onmouseover="showMenu({'ctrlid':'myitem'});" class="t9_icon t9_myitem showmenu">我的</a>
<a href="home.php?mod=spacecp" class="t9_icon t9_setup">设置</a>
<a href="home.php?mod=space&amp;do=pm" id="pm_ntc" class="t9_icon t9_pm<?php if($_G['member']['newpm']) { ?> t9_new<?php } ?>">消息</a>
<a href="home.php?mod=space&amp;do=notice" id="myprompt" class="t9_icon t9_newprompt a<?php if($_G['member']['newprompt']) { ?> t9_new<?php } ?>">提醒<?php if($_G['member']['newprompt']) { ?>(<?php echo $_G['member']['newprompt'];?>)<?php } ?></a><span id="myprompt_check"></span>
<?php if(empty($_G['cookie']['ignore_notice']) && ($_G['member']['newpm'] || $_G['member']['newprompt_num']['follower'] || $_G['member']['newprompt_num']['follow'] || $_G['member']['newprompt'])) { ?><script language="javascript">delayShow($('myprompt'), function() {showMenu({'ctrlid':'myprompt','duration':3})});</script><?php } if($_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])) { ?>
<a href="home.php?mod=task&amp;item=doing" id="task_ntc" class="t9_icon t9_task t9_new">进行中的任务</a>
<?php } if(($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))) { ?>
<a href="portal.php?mod=portalcp" class="t9_icon t9_pmanage"><?php if($_G['setting']['portalstatus'] ) { ?>门户管理<?php } else { ?>模块管理<?php } ?></a>
<?php } if($_G['uid'] && $_G['group']['radminid'] > 1) { ?>
<a href="forum.php?mod=modcp&amp;fid=<?php echo $_G['fid'];?>" target="_blank" class="t9_icon t9_fmanage"><?php echo $_G['setting']['navs']['2']['navname'];?>管理</a>
<?php } if($_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)) { ?>
<a href="admin.php" target="_blank" class="t9_icon t9_admincp">管理中心</a>
<?php } ?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra2'])) echo $_G['setting']['pluginhooks']['global_usernav_extra2'];?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra3'])) echo $_G['setting']['pluginhooks']['global_usernav_extra3'];?>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra4'])) echo $_G['setting']['pluginhooks']['global_usernav_extra4'];?>
<a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1" class="t9_icon t9_credits">积分: <?php echo $_G['member']['credits'];?></a>
        <?php if(check_diy_perm($topic)) { ?><a href="javascript:saveUserdata('diy_advance_mode', '');openDiy();" class="t9_icon t9_diy">DIY</a><?php } ?>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>" class="t9_icon t9_logout">退出</a>
</p>
</div>
<?php } elseif(!empty($_G['cookie']['loginuser'])) { ?>
<p>
<strong><a id="loginuser" class="noborder"><?php echo dhtmlspecialchars($_G['cookie']['loginuser']); ?></a></strong>
<a href="member.php?mod=logging&amp;action=login" onclick="showWindow('login', this.href)">激活</a>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
</p>
<?php } elseif(!$_G['connectguest']) { include template('member/login_simple'); } else { ?>
<div id="um">
<div class="avt y"><?php echo avatar(0,small);?></div>
<p>
<strong class="vwmy qq"><?php echo $_G['member']['username'];?></strong>
<?php if(!empty($_G['setting']['pluginhooks']['global_usernav_extra1'])) echo $_G['setting']['pluginhooks']['global_usernav_extra1'];?>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>">退出</a>
</p>
<p>
<a href="home.php?mod=spacecp&amp;ac=credit&amp;showcredit=1">积分: 0</a>
用户组: <?php echo $_G['group']['grouptitle'];?>
</p>
</div>
<?php } ?>
