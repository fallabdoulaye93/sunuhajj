<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3>
                <span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i>
                    <i class="ti-close visible-xs"></i>
                </span>
                <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <?php include("profil_user.php"); ?>
        <ul class="nav" id="side-menu">
            <li>
                <a href="#" class="waves-effect"><i class="fa fa-shopping-bag fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['bagages']; ?><span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?= WEBROOT; ?>bagages/listebagages">
                            <i data-icon="/" class="fa fa-list fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['listebagages']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>bagages/monitoringbagage">
                            <i data-icon="/" class="fa fa-map fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['monitoringbagage']; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>bagages/reclamationbagage">
                            <i data-icon="/" class="fa fa-comment fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['reclamationbagage']; ?></span>
                        </a>
                    </li>


                </ul>
            </li>

        </ul>
    </div>
</div>
