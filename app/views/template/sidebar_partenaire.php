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
                <a href="#" class="waves-effect"><i class="fa fa-users fa-fw"></i>
                    <span class="hide-menu"><?php echo $this->lang['listepartenaire']; ?><span class="fa arrow"></span></span></a>
                <ul class="nav nav-third-level">

                    <li>
                        <a href="<?= WEBROOT; ?>partenaire/monetique">
                            <i data-icon="/" class="fa fa-credit-card fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['monetique']; ?></span>
                        </a>

                    </li>
                    <li>
                        <a href="<?= WEBROOT; ?>partenaire/sponsor">
                            <i data-icon="/" class="fa fa-star-o fa-fw"></i>
                            <span class="hide-menu"><?php echo $this->lang['sponsor']; ?></span>
                        </a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</div>
