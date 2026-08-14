<template>
	<div>
		<!-- <p class="">
			<router-link class="btn btn-primary primary btn-sm rounded-pill font-weight-bold btn-block" to="/i/web/whats-new"><i class="fal fa-exclamation-circle mr-1"></i> New in Metro UI 2</router-link>
		</p> -->

		<div class="card shadow-sm mb-3 border-0" style="border-radius: 15px; background: #ffffff;">
			<div class="card-body p-3">
				<div class="d-flex justify-content-between align-items-center mb-3">
					<p class="font-weight-bold text-dark mb-0" style="font-size: 15px;">Gợi ý theo dõi</p>
					<router-link to="/i/web/discover/find-friends" class="small font-weight-bold text-primary">Xem tất cả</router-link>
				</div>

				<div v-if="loadingRecommended" class="text-center py-2">
					<b-spinner small type="grow" class="text-primary" />
				</div>

				<div v-else-if="recommended.length" class="media-list">
					<div v-for="(account, index) in recommended" :key="'rec:' + account.id" class="media align-items-center mb-3">
						<img :src="account.avatar || account.avatarUrl" class="avatar shadow-sm mr-2 cursor-pointer" width="38" height="38" style="border-radius:50%;object-fit:cover;" @click="gotoProfile(account.id)" onerror="this.onerror=null;this.src='/storage/avatars/default.png?v=0';">
						<div class="media-body overflow-hidden cursor-pointer" @click="gotoProfile(account.id)">
							<p class="font-weight-bold text-dark mb-0 text-truncate" style="font-size: 13px;line-height:1.2;">{{ account.display_name || account.name || account.username }}</p>
							<p class="text-muted mb-0 small text-truncate" style="font-size: 11px;">&commat;{{ account.username }}</p>
						</div>

						<button v-if="!account.following" class="btn btn-primary btn-sm font-weight-bold ml-2 rounded-pill px-3 py-1" style="font-size: 12px;" @click="follow(account, index)">
							Theo dõi
						</button>
						<button v-else class="btn btn-outline-secondary btn-sm font-weight-bold ml-2 rounded-pill px-2 py-1" style="font-size: 11px;" @click="unfollow(account, index)">
							Đang theo dõi
						</button>
					</div>
				</div>
				<div v-else class="text-center text-muted small py-2">
					Không có gợi ý mới
				</div>
			</div>
		</div>

		<notifications :profile="profile" />
	</div>
</template>

<script type="text/javascript">
	import Notifications from './../sections/Notifications.vue';

	export default {
		components: {
            "notifications": Notifications
		},

		data() {
			return {
				profile: {},
				recommended: [],
				loadingRecommended: true,
			}
		},

		mounted() {
			this.profile = window._sharedData.user;
			this.fetchRecommended();
		},

		methods: {
			fetchRecommended() {
				this.loadingRecommended = true;
				axios.get('/api/pixelfed/discover/accounts/popular')
				.then(res => {
					this.recommended = res.data ? res.data.slice(0, 5) : [];
					this.loadingRecommended = false;
				})
				.catch(() => {
					this.loadingRecommended = false;
				});
			},

			follow(account, index) {
				axios.post('/api/v1/accounts/' + account.id + '/follow')
				.then(() => {
					this.$set(this.recommended[index], 'following', true);
				});
			},

			unfollow(account, index) {
				axios.post('/api/v1/accounts/' + account.id + '/unfollow')
				.then(() => {
					this.$set(this.recommended[index], 'following', false);
				});
			},

			gotoProfile(id) {
				this.$router.push('/i/web/profile/' + id);
			}
		}
	}
</script>

<style lang="scss" scoped>
	.avatar {
		border-radius: 15px;
	}

	.username {
		font-size: 15px;
		margin-bottom: -6px;
	}

	.display-name {
		font-size: 12px;
	}

	.follow {
		background-color: var(--primary);
		border-radius: 18px;
		font-weight: 600;
		padding: 5px 15px;
	}

	.btn-white {
		background-color: #fff;
		border: 1px solid #F3F4F6;
	}
</style>
