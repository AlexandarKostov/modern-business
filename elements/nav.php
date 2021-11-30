<?php $current_page = basename($_SERVER["PHP_SELF"]); ?>
	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="container">
		    <a class="navbar-brand custom-title" href="home"><img class="mx-2" src="admin/assets/<?php echo $serverInfo["Logo"]; ?>" width="45" height="45"> <?php echo $serverInfo["Title"]; ?></a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
	      		<span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavDropdown">
		      	<ul class="navbar-nav ms-auto">
			        <li class="nav-item">
		          		<a class="nav-link <?php echo($current_page == "index.php") ? 'active' : ''; ?>" href="home">Home</a>
			        </li>
			        <li class="nav-item">
		          		<a class="nav-link <?php echo($current_page == "about-us.php") ? 'active' : ''; ?>" href="about-us">About</a>
			        </li>
			        <li class="nav-item">
		          		<a class="nav-link <?php echo($current_page == "pricing.php") ? 'active' : ''; ?>" href="pricing">Pricing</a>
			        </li>
			        <li class="nav-item">
		          		<a class="nav-link <?php echo($current_page == "blog.php" || $current_page == "view-post.php") ? 'active' : ''; ?>" href="blog">Blog</a>
			        </li>
			        <li class="nav-item">
		          		<a class="nav-link <?php echo($current_page == "portfolio.php" || $current_page == "view-item.php") ? 'active' : ''; ?>" href="portfolio">Portfolio</a>
			        </li>
			        <?php 
			        	if (isLogged())
			        	{
			        		echo '
			        		<li class="nav-item dropdown">
					          	<a class="nav-link dropdown-toggle'; ?> <?php echo($current_page == "profile.php") ? 'active' : ''; echo'" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					            	<img src="assets/profile/'.$userData["Avatar"].'" width="32" height="32" class="rounded-circle me-2">'.$userData["Name"].'
					          	</a>
					          	<ul class="dropdown-menu" aria-labelledby="navbarDropdown">'; ?>
					            	<?php if (adminPerm($userAdmin) == 1) { echo '<li><a class="dropdown-item" href="admin">Dashboard</a></li>'; } echo'
					            	<li><a class="dropdown-item" href="profile">Profile</a></li>
					            	<li><hr class="dropdown-divider"></li>
					            	<li><a class="dropdown-item" href="logout">Logout</a></li>
					          	</ul>
					        </li>
					        ';
			        	}
			        	else
			        	{
			        		echo '<li class="nav-item">
				          		<a class="nav-link" href="#" id="modalLogin">Sign In</a>
					        </li>
					        <li class="nav-item">
				          		<a class="btn btn-primary btn-custom" href="#" id="modalRegister">Sign Up</a>
					        </li>';
			        	}
			        ?>
		      	</ul>
		    </div>
		</div>
	</nav>