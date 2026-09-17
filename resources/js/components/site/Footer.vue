<template>
    <footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="footer-item">
						<div class="company-brand">
							<img :src="logo" alt="logo" class="footer-logo">
						</div>
					</div>
				</div>
				<div class="col-md-1">
					<div class="footer-menu">
						<h5>Menu</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a :href="route('home')">Home</a>
							</li>			
						</ul>
					</div>
				</div>
				<div class="col-md-2">
					<div class="footer-menu">
						<h5>Minha conta</h5>
						<ul class="menu-list">
							<li class="menu-item" v-if="!user">
								<a :href="route('login')">Sign In</a>
							</li>
							<li class="menu-item" v-if="user">
								<a :href="route('usuarios.index')">Minha conta</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer-menu">
						<h5>Contato</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<label>{{ phone }}</label>
							</li>
							<li class="menu-item">
								<label>{{ streets }}</label>
							</li>
							<li class="menu-item">
								<a :href="`mailto:${email}`">{{ email }}</a>
							</li>						
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<div id="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="copyright">
						<div class="row">
							<div class="col-md-6">
								<p>© 2022 All rights reserved. Free HTML Template by <a
										href="https://www.templatesjungle.com/" target="_blank">TemplatesJungle</a></p>
							</div>
							<div class="col-md-6">
								<site-social-links 
									:links='links'
									:class-item="'align-right'"
								>
								</site-social-links>
							</div>
						</div>
					</div><!--grid-->
				</div><!--footer-bottom-content-->
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        data(){
            return {
                links : []
            }
        },
		props: {
            logo: {
				type: String,
                default: '',
			},
			user: {
				type: Object,
				default: null,
			},
			email: {
				type: String,
				default: '',
			},
			phone: {
				type: String,
				default: '',
			},
			streets: {
				type: String,
				default: '',
			}
        },
		methods: {
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
			this.getLinks();
		},
    }
</script>
