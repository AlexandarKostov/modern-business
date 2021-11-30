<?php $current_page = basename($_SERVER["PHP_SELF"]); if (isset($_GET['filter'])) { $navFilter = $_GET['filter']; } ?>
	<nav id="sidebar">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="bi bi-list"></i>
                <span class="sr-only">Menu</span>
            </button>
        </div>

        <div class="p-4 pt-5">
            <h1><a href="#" class="logo">Code4You</a></h1>

            <ul class="list-unstyled components mb-5">
                <li><a class="small text-uppercase <?php echo($current_page == "index.php") ? 'nav-active' : ''; ?>" href="dashboard"><i class="bi bi-speedometer2 pe-2"></i> Dashboard</a></li>
                <li><a class="small text-uppercase" href="../home"><i class="bi bi-globe pe-2"></i> Website</a></li>
                


                <div class="sidebar-item-divide mt-4 small text-muted text-uppercase">SERVER SETTINGS</div>
                <li>
                    <a href="server" class="<?php echo($current_page == "server.php") ? 'nav-active' : ''; ?>"><i class="bi bi-gear pe-2"></i>Server</a>
                </li>

                <div class="sidebar-item-divide mt-4 small text-muted text-uppercase">ADDONS</div>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle <?php echo($current_page == "page.php") ? 'nav-active' : ''; ?>"><i class="bi bi-journals pe-2"></i> Pages</a>
                    <ul class="collapse list-unstyled <?php echo($current_page == "page.php") ? 'show' : ''; ?>" id="pageSubmenu">
                        <li>
                            <a href="page?filter=home" class="<?php echo($current_page == "page.php" && $navFilter == "home") ? 'nav-active' : ''; ?>">Home</a>
                            <a href="page?filter=about" class="<?php echo($current_page == "page.php" && $navFilter == "about") ? 'nav-active' : ''; ?>">About</a>
                            <a href="page?filter=pricing" class="<?php echo($current_page == "page.php" && $navFilter == "pricing") ? 'nav-active' : ''; ?>">Pricing</a>
                            <a href="page?filter=blog" class="<?php echo($current_page == "page.php" && $navFilter == "blog") ? 'nav-active' : ''; ?>">Blog</a>
                            <a href="page?filter=portfolio" class="<?php echo($current_page == "page.php" && $navFilter == "portfolio") ? 'nav-active' : ''; ?>">Portfolio</a>
                            <a href="page?filter=faq" class="<?php echo($current_page == "page.php" && $navFilter == "faq") ? 'nav-active' : ''; ?>">FAQ</a>
                            <!-- contact -->
                        </li>
                    </ul>
                </li>

                <li class="mt-4">
                    <a href="users" class="<?php echo($current_page == "users.php") ? 'nav-active' : ''; ?>"><i class="bi bi-people pe-2"></i> Users</a>
                </li>

                <li class="mt-4">
                    <a href="newsletters" class="<?php echo($current_page == "newsletters.php") ? 'nav-active' : ''; ?>"><i class="bi bi-envelope pe-2"></i> Newsletters</a>
                </li>

                <div class="sidebar-item-divide mt-4 small text-muted text-uppercase">CONTENT</div>
                <li>
                    <a href="blog-post?a=default" class="<?php echo($current_page == "blog-post.php") ? 'nav-active' : ''; ?>"><i class="bi bi-table pe-2"></i></i>Blog</a>
                </li>
                <li>
                    <a href="port-item" class="<?php echo($current_page == "port-item.php") ? 'nav-active' : ''; ?>"><i class="bi bi-hdd-network pe-2"></i>Portfolio</a>
                </li>
                <li>
                    <a href="testimonial" class="<?php echo($current_page == "testimonial.php") ? 'nav-active' : ''; ?>"><i class="bi bi-award pe-2"></i>Testimonial</a>
                </li>
            </ul>

            <div class="position-absolute bottom-0 mb-4" style="width: 100%;">
                <a href="logout" class="btn btn-secondary logout"><i class="bi bi-box-arrow-left pe-2"></i> Logout</a>
            </div>


        </div>
    </nav>