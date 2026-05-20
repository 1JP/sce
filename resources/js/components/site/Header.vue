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
							<a v-if="name" href="#" class="user-account for-buy dropdown-toggle" 
								id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false"
							>
                                <i class="icon icon-user me-1"></i>
                                <span>{{ name }}</span>
                            </a>
							<a v-else :href="routeLogout" class="user-account for-buy">
								<i class="icon icon-user me-1"></i>
							</a>
							<ul v-if="name" class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="">
								<li>
									<a class="dropdown-item" :href="route('usuarios.index')">
										Minha Conta
									</a>
								</li>
								<li>
									<a class="dropdown-item" :href="route('admin.dashboard')" v-if="isRole">
										Área administrativa
									</a>
								</li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" :href="routeLogout">Sign out</a></li>
							</ul>
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
                                <img :src="logo" alt="logo" class="img-fluid ratio ratio-7x1 object-fit-contain" style="width: 189px; height: 60px;">
                            </a>
						</div>
					</div>
					<div class="col-md-10 py-2">
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
                links : [],
                routeHome: route('home'),
				routeLogout: route('auth.logout'),
				routeScript: 'http://127.0.0.1:8000/js/script.js',
            }
        },
		props: {
            name: {
                type: String,
                default: '',
            },
			logo: {
				type: String,
                default: '',
			},
			isRole: {
                type: Boolean,
                default: false
            },
        },
		methods: {
			loadScript() {
				const script = document.createElement('script');
				script.src = this.routeScript;
				script.async = true;
				document.body.appendChild(script);
			},
			getLinks() {
				axios.get(route('api.settings.links'))
					.then(response => {
						this.links = response.data.data.map(link => ({
							route: link.body,
							icon: `bi bi-${link.name}`,
							name: link.name.charAt(0).toUpperCase() + link.name.slice(1),
						}));
					})
					.catch(error => {
						console.error('Error fetching links:', error);
					});
			}
		},
		mounted() {
			this.loadScript();
			this.getLinks();
		},
    }
</script>
