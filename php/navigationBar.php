<?php
if (isset($_SESSION["username"])) {
  echo '
<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
			<div class="container-fluid">
				<a class="navbar-brand mx-5" href="home.php"><img src="img/source/Logo.png" alt="" /></a>
				<form class="d-flex">
					<button type="type" class="rounded-0 btn-search">
						<i class="bi bi-search mx-2"></i>
					</button>
					<div>
						<input class="form-control me-2 search rounded-0 shadow-none" type="search" placeholder="Search" aria-label="Search" />
					</div>
				</form>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mx-auto mb-4 mb-lg-0">
						<li class="nav-item mx-2 dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Men
							</a>
							<ul class="dropdown-menu" aria-la elledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">Sneaker</a></li>
								<li><a class="dropdown-item" href="#">Boots</a></li>
								<li><a class="dropdown-item" href="#">Sandals</a></li>
								<li><a class="dropdown-item" href="#">Slippers</a></li>
							</ul>
						</li>
						<li class="nav-item mx-2 dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Women
							</a>
							<ul class="dropdown-menu" aria-la elledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">Sneaker</a></li>
								<li><a class="dropdown-item" href="#">Boots</a></li>
								<li><a class="dropdown-item" href="#">Sandals</a></li>
								<li><a class="dropdown-item" href="#">Slippers</a></li>
							</ul>
						</li>
						<li class="nav-item mx-2 dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Brand
							</a>
							<ul class="dropdown-menu" aria-la elledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">Nike</a></li>
								<li><a class="dropdown-item" href="#">Adidas</a></li>
								<li><a class="dropdown-item" href="#">Timberland</a></li>
								<li><a class="dropdown-item" href="#">Dr Martens</a></li>
								<li><a class="dropdown-item" href="#">Others</a></li>
							</ul>
						</li>

						<li class="nav-item mx-2">
							<a class="nav-link" href="#">Collection</a>
						</li>
						<li class="nav-item mx-2">
							<a class="nav-link" href="#">Contact</a>
						</li>
					</ul>

					<ul class="navbar-nav m-auto mb-2 mb-lg-0">
            <li class="nav-item my-auto mx-2">
              <a class="nav-link fw-normal" href="cart.php"><img src="img/source/cart.png" alt="" height="25px"></a>
						</li>
						<li class="nav-item my-auto mx-2">
							<p class="nav-link fw-normal username"><a href="userprofile.php">'.$_SESSION["username"].'</a></p>
						</li>
						<div class="vr fw-normal my-3"></div>
						<li class="nav-item my-auto mx-2">
							<a class="nav-link fw-normal" href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
';
} else {
  echo '
    <div class="container">
      <nav
        class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top"
      >
        <div class="container-fluid">
          <a class="navbar-brand mx-5" href="home.php"
            ><img src="img/source/Logo.png" alt=""
          /></a>
          <form class="d-flex">
            <button type="type" class="rounded-0 btn-search">
              <i class="bi bi-search mx-2"></i>
            </button>
            <div>
              <input
                class="form-control me-2 search rounded-0 shadow-none"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
            </div>
          </form>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2 dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Men
                </a>
                <ul class="dropdown-menu" aria-la elledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Sneaker</a></li>
                  <li><a class="dropdown-item" href="#">Boots</a></li>
                  <li><a class="dropdown-item" href="#">Sandals</a></li>
                  <li><a class="dropdown-item" href="#">Slippers</a></li>
                </ul>
              </li>
              <li class="nav-item mx-2 dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Women
                </a>
                <ul class="dropdown-menu" aria-la elledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Sneaker</a></li>
                  <li><a class="dropdown-item" href="#">Boots</a></li>
                  <li><a class="dropdown-item" href="#">Sandals</a></li>
                  <li><a class="dropdown-item" href="#">Slippers</a></li>
                </ul>
              </li>
              <li class="nav-item mx-2 dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Brand
                </a>
                <ul class="dropdown-menu" aria-la elledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Nike</a></li>
                  <li><a class="dropdown-item" href="#">Adidas</a></li>
                  <li><a class="dropdown-item" href="#">Timberland</a></li>
                  <li><a class="dropdown-item" href="#">Dr Martens</a></li>
                  <li><a class="dropdown-item" href="#">Others</a></li>
                </ul>
              </li>

              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Collection</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>

            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2">
                <a class="nav-link fw-normal" href="login.php">Login</a>
              </li>
              <div class="vr fw-normal"></div>
              <li class="nav-item mx-2">
                <a class="nav-link fw-normal" href="user-registration.php">Register</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    ';
}
