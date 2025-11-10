<template id="pickup_requestView">
	<div>
		<!-- Modals are preserved at the top -->
		<div id="openReviewModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Rate this Pick Up</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body" style="display: grid;justify-content: center;align-items: center;">
						<div class="container">
							<ul class="card-meta list-inline">
								<li class="list-inline-item">
									<i v-for="(star, index) in 5" :key="index" class="fa fa-star list-inline-item" :style="{color: index < selectedStars ? 'gold' : '#ccc',fontSize: '40px' }" @click="toggleStar(index)">
									</i>
								</li>
							</ul>
							<p>
								<textarea name="notes" cols="25" rows="3" v-model="reviewcomment" data-vv-as="notes" type="text"></textarea>
								</br>
								<button @click="sendReview()" class="btn btn-primary" type="submit">Submit<i class="fa fa-send"></i></button>
							</p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="page-container" style="padding-top: 100px;">
			<section class="section-sm">
				<div class="container">
					<div class="card tracking-summary-card mb-4">
						<div class="card-body">
							<div class="text-center mb-4">
								<h2 class="page-title">{{ data.item_name }}</h2>
								<p class="page-subtitle text-muted">Tracking ID: #{{ data.tracking_id }}</p>
							</div>

							<div class="progress-tracker">
								<div class="progress-line" :style="{ width: (data.pickup_status / 3 * 100) + '%' }"></div>
								<div class="progress-step" :class="{'active': data.pickup_status >= 0}">
									<div class="progress-icon"><i class="ti-receipt"></i></div>
									<div class="progress-label">Processing</div>
								</div>
								<div class="progress-step" :class="{'active': data.pickup_status >= 1}">
									<div class="progress-icon"><i class="ti-shopping-bag"></i></div>
									<div class="progress-label">Picked Up</div>
								</div>
								<div class="progress-step" :class="{'active': data.pickup_status >= 2}">
									<div class="progress-icon"><i class="ti-truck"></i></div>
									<div class="progress-label">In Transit</div>
								</div>
								<div class="progress-step" :class="{'active': data.pickup_status >= 3}">
									<div class="progress-icon"><i class="ti-check-box"></i></div>
									<div class="progress-label">Delivered</div>
								</div>
							</div>
						</div>

						<div style="max-width:400px;margin:0 auto;">
							<img class="img-fluid rounded mx-auto d-block" :src="data.picture || 'assets/images/carts.jpg'" alt="Item Picture" style="max-height: 250px; width: 100%; height: auto; display: block;">
						</div>


						<?php if (ROLE_ID == "driver") { ?>
							<div class="card-footer text-center" v-if="data.pickup_status == 0 || data.pickup_status == 1 || data.pickup_status == 2">
								<div v-if="data.pickup_status == 0" class="btn-group w-100">
									<button @click="rejectPickup(data.id)" class="btn btn-outline-danger w-50">Reject</button>
									<button @click="acceptPickup(data.id)" class="btn btn-success w-50">Accept Request</button>
								</div>
								<div v-if="data.pickup_status == 1">
									<button @click="startPickup(data.id)" class="btn btn-info btn-block"><i class="ti-truck"></i> Start Journey</button>
								</div>
								<div v-if="data.pickup_status == 2">
									<button @click="endPickup(data.id)" class="btn btn-success btn-block"><i class="ti-check-box"></i> End Journey</button>
								</div>
							</div>
						<?php } ?>
					</div>

					<div class="row">
						<div class="col-lg-8">

							<div class="card mb-4">
								<div class="card-header">
									<h5 class="mb-0">Delivery Timeline</h5>
								</div>
								<div class="card-body">
									<ul class="timeline">
										<li class="timeline-item" :class="{ 'active': data.pickup_status >= 3 }">
											<div class="timeline-icon success"><i class="ti-check"></i></div>
											<strong>Delivered</strong>
											<span class="text-muted float-right" v-if="data.pickup_status == 3"></span>
										</li>
										<li class="timeline-item" :class="{ 'active': data.pickup_status >= 2 }">
											<div class="timeline-icon info"><i class="ti-truck"></i></div>
											<strong>In Transit</strong>
											<span class="text-muted float-right" v-if="data.pickup_status >= 2"></span>
										</li>
										<li class="timeline-item" :class="{ 'active': data.pickup_status >= 1 }">
											<div class="timeline-icon primary"><i class="ti-shopping-bag"></i></div>
											<strong>Item Picked Up</strong>
											<span class="text-muted float-right" v-if="data.pickup_status >= 1"></span>
										</li>
										<li class="timeline-item active">
											<div class="timeline-icon secondary"><i class="ti-receipt"></i></div>
											<strong>Request Received</strong>
											<span class="text-muted float-right">{{ data.created_at }}</span>
										</li>
									</ul>
								</div>
							</div>

							<div class="card mb-4">
								<div class="card-header">
									<h5 class="mb-0">Shipment Details</h5>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-5">
											<div class="location-group">
												<div class="location-icon from"><i class="ti-location-pin"></i></div>
												<div>
													<small class="text-muted">FROM</small>
													<p class="font-weight-bold mb-0">{{data.pickup_address}}, {{data.pickup_city}}</p>
												</div>
											</div>
										</div>
										<div class="col-md-2 text-center my-3 my-md-0"><i class="ti-arrow-right text-muted" style="font-size: 1.5rem;"></i></div>
										<div class="col-md-5">
											<div class="location-group">
												<div class="location-icon to"><i class="ti-flag-alt"></i></div>
												<div>
													<small class="text-muted">TO</small>
													<p class="font-weight-bold mb-0">{{data.receiver_address}}, {{data.receiver_city}}</p>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<p><strong>Notes:</strong> {{ data.notes || 'No special instructions.' }}</p>
								</div>
							</div>

							<div class="card mb-4" v-if="data.driver_id != null">
								<div class="card-header">
									<h5 class="mb-0">Rider Information</h5>
								</div>
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-md-8">
											<p class="font-weight-bold mb-1"><i class="ti-user"></i> {{data.firstname}} {{data.lastname}}</p>
											<p class="text-muted mb-0"><i class="ti-mobile"></i> {{ data.phoneno }}</p>
										</div>
										<div class="col-md-4 text-md-right mt-3 mt-md-0">
											<a :href="'tel:'+ data.phoneno" class="btn btn-success"><i class="ti-mobile"></i> Call Rider</a>
										</div>
									</div>
								</div>
							</div>

							<?php if (ROLE_ID == "user") { ?>
								<div class="card mb-4" v-if="data.pickup_status == 3">
									<div class="card-body text-center">
										<div v-if="data.rate == 0">
											<h5 class="mb-3">How was your delivery?</h5>
											<button @click="showPopOpenReviewModal(data.id)" class="btn btn-primary"><i class="ti-star"></i> Rate This Delivery</button>
										</div>
										<div v-if="data.rate != 0">
											<h5 class="mb-3">You rated this delivery:</h5>
											<i v-for="n in data.rate" :key="n" class="ti-star" style="color: gold; font-size: 1.5rem;"></i>
										</div>
									</div>
								</div>
							<?php } ?>

						</div>

						<aside class="col-lg-4">
							<div class="widget">
								<h4 class="widget-title">Recent Requests</h4>
								<div v-for="(data1,index) in records">
									<article class="card request-card mb-3">
										<div class="card-body">
											<h5 class="mb-1"><router-link :to="'/pickup_request/view/' + data1.id">{{data1.item_name}}</router-link></h5>
											<small class="text-muted">To: {{ data1.receiver_city }}</small>
										</div>
									</article>
								</div>
							</div>
						</aside>
					</div>
				</div>
			</section>
		</div>
	</div>
</template>

<script>
	var Pickup_RequestViewComponent = Vue.component('pickup_requestView', {
		template: '#pickup_requestView',
		mixins: [ViewPageMixin],
		props: {
			pagename: {
				type: String,
				default: 'pickup_request',
			},
			routename: {
				type: String,
				default: 'pickup_requestview',
			},
			apipath: {
				type: String,
				default: 'pickup_request/view',
			},
		},
		data: function() {
			return {
				data: {
					default: {
						id: '',
						item_name: '',
						category: '',
						tracking_id: '',
						pickup_userid: '',
						distance: '',
						receiver_userid: '',
						receiver_name: '',
						receiver_phoneno: '',
						receiver_email: '',
						driver_id: '',
						pickup_address: '',
						pickup_state: '',
						pickup_city: '',
						receiver_address: '',
						receiver_city: '',
						receiver_state: '',
						picture: '',
						pickup_code: '',
						delivery_option_id: '',
						totalamount: '',
						created_at: '',
						delivery_status: '',
						pickup_status: '',
						payment_status: '',
						email: '',
						phoneno: '',
						role_id: '',
						firstname: '',
						lastname: '',
						profile_pics: '',
						items: '',
						delivery_category: '',
						delivery_option: '',
						pricing_per_km: '',
						pricing_higher_km: '',
						delivery_amount: ''
					},
				},
				records: [],
				reviewcomment: '',
				reviewid: '',
				selectedStars: 0
			}
		},
		computed: {
			pageTitle: function() {
				return 'View  Pickup Request';
			},
		},
		methods: {
			load: function() {
				this.resetData();
				this.loading = true;
				this.showError = false;
				this.ready = false;
				this.records = [];
				this.$http.get(this.apiUrl).then(function(response) {
						this.loading = false;
						this.ready = true;
						if (response.body) {
							this.data = response.body.data;
							this.records = response.body.records;
						} else {
							this.$root.$emit('requestError', response);
						}

					},
					function(response) {
						this.loading = false;
						this.$root.$emit('requestError', response);
					});
			},
			rejectPickup: function(id) {
				var apiurl = setApiUrl('components/rejectPickup/' + id);
				this.$http.get(apiurl).then(function(response) {
						console.log(response)
						this.load()
					},
					function(response) {
						console.log(response)
					});
			},
			acceptPickup: function(id) {
				var apiurl = setApiUrl('components/acceptPickup/' + id);
				this.$http.get(apiurl).then(function(response) {
						console.log(response)
						this.load()
					},
					function(response) {
						console.log(response)
					});
			},
			startPickup: function(id) {
				var apiurl = setApiUrl('components/startPickup/' + id);
				this.$http.get(apiurl).then(function(response) {
						console.log(response)
						this.load()
					},
					function(response) {
						console.log(response)
					});
			},
			setPaymentInfo: function(val) {
				console.log(val)
				this.paymentsinfo = val;
				$('#openPaymentInfoModal').modal();
			},
			confirmPayment: function(id) {
				var apiurl = setApiUrl('components/confirmPayment/' + id);
				this.$http.get(apiurl).then(function(response) {
						console.log(response)
						//$('#openPaymentInfoModal').modal("hide");
						this.load()
					},
					function(response) {
						console.log(response)
					});
			},
			driverStatus: function(id) {
				var apiurl = setApiUrl('components/driverStatus/' + id);
				this.$http.get(apiurl).then(function(response) {
						console.log(response)
						this.load()
					},
					function(response) {
						console.log(response)
					});
			},
			endPickup: function(id) {
				var apiurl = setApiUrl('components/endPickup/' + id);
				this.$http.get(apiurl).then(function(response) {
						console.log(response)
						this.load()
					},
					function(response) {
						console.log(response)
					});
			},
			cancelPickup: function(id) {
				var apiurl = setApiUrl('components/cancelPickup/' + id);
				this.$http.get(apiurl).then(function(response) {
						console.log(response)
						this.load()
					},
					function(response) {
						console.log(response)
					});
			},
			showPopOpenReviewModal: function(id) {
				this.reviewid = id;
				$('#openReviewModal').modal();
			},
			toggleStar(index) {
				if (this.selectedStars === index + 1) {
					this.selectedStars = 0;
				} else {
					this.selectedStars = index + 1;
				}
			},
			sendReview: function() {
				if (!this.reviewid || !this.reviewcomment || this.selectedStars == 0) {
					alert("Please fill up the review and rating items")
				} else {
					var payload_json = '{"review": "' + this.reviewcomment + '","rate": "' + this.selectedStars + '"}';
					console.log(payload_json)
					this.loading1 = true;
					var self = this;
					var apiurl = setApiUrl('Pickup_request/edit/' + this.reviewid);
					this.$http.post(apiurl, payload_json).then(function(response) {
							console.log(response)
							$('#openReviewModal').modal("hide");
						},
						function(response) {
							console.log(response)
							$('#openReviewModal').modal("hide");
							setTimeout(function() {
								self.showError = false;
							}, 100);
						});
				}
			},
			resetData: function() {
				this.data = {
					id: '',
					item_name: '',
					category: '',
					tracking_id: '',
					pickup_userid: '',
					distance: '',
					receiver_userid: '',
					receiver_name: '',
					receiver_phoneno: '',
					receiver_email: '',
					driver_id: '',
					pickup_address: '',
					pickup_state: '',
					pickup_city: '',
					receiver_address: '',
					receiver_city: '',
					receiver_state: '',
					picture: '',
					pickup_code: '',
					delivery_option_id: '',
					totalamount: '',
					created_at: '',
					delivery_status: '',
					pickup_status: '',
					payment_status: '',
					email: '',
					phoneno: '',
					role_id: '',
					firstname: '',
					lastname: '',
					profile_pics: '',
					items: '',
					delivery_category: '',
					delivery_option: '',
					pricing_per_km: '',
					pricing_higher_km: '',
					delivery_amount: '',
				}
			},
		},
	});
</script>

<style scoped>
	.page-header-summary {
		border: 1px solid #e9ecef;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
	}

	.page-title {
		font-weight: 700;
	}

	.page-subtitle {
		color: #6c757d;
	}

	.tracking-summary-card {
		border: 1px solid #e9ecef;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
	}

	.progress-tracker {
		display: flex;
		justify-content: space-between;
		position: relative;
		width: 100%;
	}

	.progress-tracker::before {
		content: '';
		position: absolute;
		top: 20px;
		left: 0;
		right: 0;
		height: 4px;
		background-color: #e9ecef;
		transform: translateY(-50%);
		z-index: 1;
	}

	.progress-line {
		position: absolute;
		top: 20px;
		left: 0;
		height: 4px;
		background-color: #28a745;
		transform: translateY(-50%);
		z-index: 2;
		transition: width 0.5s ease;
	}

	.progress-step {
		position: relative;
		z-index: 3;
		text-align: center;
	}

	.progress-icon {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		background-color: #e9ecef;
		color: #adb5bd;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 10px;
		border: 3px solid #e9ecef;
		transition: all 0.4s ease;
	}

	.progress-label {
		font-size: 0.8rem;
		color: #adb5bd;
		font-weight: 600;
		transition: color 0.4s ease;
	}

	.progress-step.active .progress-icon {
		background-color: #28a745;
		color: #fff;
		border-color: #28a745;
	}

	.progress-step.active .progress-label {
		color: #212529;
	}

	/* Timeline Styles */
	.timeline {
		list-style: none;
		padding: 0;
		position: relative;
	}

	.timeline:before {
		content: '';
		position: absolute;
		top: 0;
		bottom: 0;
		left: 19px;
		width: 2px;
		background: #e9ecef;
	}

	.timeline-item {
		margin-bottom: 20px;
		position: relative;
		padding-left: 50px;
	}

	.timeline-item:last-child {
		margin-bottom: 0;
	}

	.timeline-icon {
		position: absolute;
		left: 0;
		width: 40px;
		height: 40px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 1.2rem;
		color: #fff;
		background: #ced4da;
	}

	.timeline-item.active .timeline-icon {
		background: #6c757d;
	}

	.timeline-item.active .timeline-icon.success {
		background-color: #28a745;
	}

	.timeline-item.active .timeline-icon.info {
		background-color: #17a2b8;
	}

	.timeline-item.active .timeline-icon.primary {
		background-color: #007bff;
	}

	.timeline-item.active strong {
		font-weight: bold;
	}

	/* Reusing card styles */
	.request-card {
		border: 1px solid #e9ecef;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
		transition: all 0.3s ease;
	}

	.request-card:hover {
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
		transform: translateY(-5px);
	}

	.card-header h5 {
		font-weight: 600;
		font-size: 1.1rem;
	}

	.location-group {
		display: flex;
		align-items: center;
	}

	.location-icon {
		font-size: 1.5rem;
		margin-right: 15px;
		width: 30px;
		text-align: center;
	}

	.location-icon.from {
		color: #28a745;
	}

	.location-icon.to {
		color: #dc3545;
	}

	.card-footer {
		background-color: #f8f9fa;
		border-top: 1px solid #e9ecef;
	}
</style>