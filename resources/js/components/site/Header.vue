<template>
    <div id="header-wrap">
		<div class="top-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<site-social-links 
                            :links="links">
                        </site-social-links>
					</div>
					<div class="col-md-6">
						<div class="right-element">
							<a href="#" class="user-account for-buy">
                                <i class="icon icon-user"></i>
                                <span>Account</span>
                            </a>
							<div class="action-menu">
								<div class="search-bar">
									<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
										<i class="icon icon-search"></i>
									</a>
									<form role="search" method="get" class="search-box">
										<input class="search-field text search-input" placeholder="Search"
											type="search">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <header id="header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-2">
						<div class="main-logo">
							<a :href="routeHome">
                                <img src="images/main-logo.png" alt="logo">
                            </a>
						</div>
					</div>
					<div class="col-md-10">
						<site-nav-bar></site-nav-bar>
					</div>
				</div>
			</div>
		</header>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                links : [
                    { route: "#", icon: "icon icon-facebook", name: "Facebook" },
                ],
                routeHome: route('home')
            }
        }
    }
</script>
