<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>General</h3>
		<ul class="nav side-menu">
			<li>
				<a href="<?php echo $this->master->adminUrl()?>">
					<i class="fa fa-home"></i>
					Dashboard
				</a>
			</li>
			<li>
				<a><i class="fa fa-users"></i> Tanaman <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" style="display: none">
					<li><a href="<?php echo $this->master->adminUrl('tanaman')?>">Data Tanaman</a>
					<li><a href="<?php echo $this->master->adminUrl('famili')?>">Famili Tanaman</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="<?php echo $this->master->adminUrl('settingweb')?>"><i class="fa fa-info-circle"></i> Setting</a>
		</li>

		<li>
			<a><i class="fa fa-gear"></i> Extra <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu" style="display: none">
				<!-- <li>
					<a href="<?php //echo $this->master->adminUrl('extra/export')?>">Export Database</a>
				</li> -->
				<li>
					<a href="<?php echo $this->master->adminUrl('admins')?>">Admin</a>
				</li>
			</ul>
		</li>
	</ul>
</div>
</div>
<div class="sidebar-footer hidden-small">
<a data-toggle="tooltip" data-placement="top" title="Settings">
	<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
</a>
<a data-toggle="tooltip" data-placement="top" title="FullScreen">
	<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
</a>
<a data-toggle="tooltip" data-placement="top" title="Lock">
	<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
</a>
<a data-toggle="tooltip" data-placement="top" title="Logout">
	<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
</a>
</div>
<!-- /menu footer buttons -->
