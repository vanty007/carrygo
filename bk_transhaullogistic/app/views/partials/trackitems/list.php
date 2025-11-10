<template id="trackitemsList">
  <div>

    <?php if (ROLE_ID == "user") { ?>

      <div id="openPaymentModal" class="modal fade" role="dialog"> ... </div>
      <div id="openReviewModal" class="modal fade" role="dialog"> ... </div>

      <section class="page-header">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="page-title">Track Your Deliveries</h1>
              <p class="page-subtitle">Enter your tracking ID to find a specific package or view your active and past deliveries below.</p>
              <div class="mt-4">
                <div class="search-bar-container mx-auto" style="max-width: 500px;">
                  <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control search-input" type="text" name="search" placeholder="Enter Tracking ID..." />
                  <button @click="dosearch()" class="btn search-button">Track</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-sm" style="background-color: #f7f9fc;">
        <div class="container">
          <div v-if="records.length">
            <div v-for="(data,index) in records">

              <article class="card request-card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                  <h5 class="mb-0 mr-3"><i class="ti-package mr-2"></i> {{data.records.item_name}}</h5>
                  <span class="badge badge-light p-2">#{{data.records.tracking_id}}</span>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="location-group">
                        <div class="location-icon from"><i class="ti-location-pin"></i></div>
                        <div>
                          <small class="text-muted">FROM</small>
                          <p class="font-weight-bold mb-0">{{data.records.pickup_city}}, {{data.records.pickup_state}}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 text-center my-3 my-md-0">
                      <i class="ti-arrow-right text-muted" style="font-size: 1.5rem;">&#8358;{{data.records.totalamount}}</i>
                    </div>
                    <div class="col-md-5">
                      <div class="location-group">
                        <div class="location-icon to"><i class="ti-flag-alt"></i></div>
                        <div>
                          <small class="text-muted">TO</small>
                          <p class="font-weight-bold mb-0">{{data.records.receiver_city}}, {{data.records.receiver_state}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr v-if="data.records.driver_id != null">
                  <div class="row align-items-center" v-if="data.records.driver_id != null">
                    <div class="col-md-6">
                      <small class="text-muted">Assigned Rider</small>
                      <p class="font-weight-bold mb-0"><i class="ti-user"></i> {{data.records.firstname}} {{data.records.lastname}}</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                      <a :href="'tel:'+ data.records.phoneno" class="btn btn-sm btn-outline-success"><i class="ti-mobile"></i> Call Rider</a>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <div class="status-group">
                    <strong class="mr-2">Status:</strong>
                    <span :class="getPickupStatusClass(data.records.pickup_status)">{{ statusPickUpText(data.records.pickup_status, data.records.driver_id) }}</span>
                  </div>
                  <div class="action-group">
                    <a href="#" @click="showPopOpenReviewModal(data.records.id)" class="btn btn-xs btn-outline-primary" v-if="data.records.pickup_status == 3 && data.records.rate == 0"><i class="ti-star"></i> Rate Delivery</a>
                    <div v-if="data.records.pickup_status == 3 && data.records.rate != 0">
                      <i v-for="(star, index) in data.records.rate" :key="index" class="ti-star" style="color: gold; font-size: 1.2rem;"></i>
                    </div>
                  </div>
                  <div class="action-group" style="white-space: nowrap;">
                    <a @click="cancelPickup(data.records.id)" href="#" class="btn btn-xs btn-outline-danger" v-if="data.records.pickup_status == 0 && data.records.driver_id == null">
                      <i class="ti-na"></i> Cancel
                    </a>
                    <router-link :to="'/pickup_request/view/' + data.records.id" class="btn btn-xs btn-outline-primary">
                      <i class="ti-eye"></i> View Details
                    </router-link>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <div class="row justify-content-center" v-else>
            <div class="col-sm-12 text-center py-5">
              <div class="empty-state-card">
                <h3 class="mt-3">No Pending Deliveries</h3>
                <p class="text-muted">Ready to deliver something? Click the button below to get started!</p>
                <div class="mt-4">
                  <router-link to="/pickup_request/add" class="btn btn-primary btn-lg px-5 py-3">Request a New Pickup</router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <?php } else if (ROLE_ID == "driver") { ?>

      <div id="openPaymentInfoModal" class="modal fade" role="dialog">
      </div>

      <section class="page-header">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="page-title">My Deliveries</h1>
              <p class="page-subtitle">View your active and completed delivery jobs.</p>
              <div class="mt-4">
                <div class="search-bar-container mx-auto" style="max-width: 500px;">
                  <input @keyup.enter="dosearch()" v-model="searchtext" class="form-control search-input" type="text" name="search" placeholder="Search by Tracking ID..." />
                  <button @click="dosearch()" class="btn search-button">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-sm" style="background-color: #f7f9fc;">
        <div class="container">
          <div v-if="records.length">
            <div v-for="(data,index) in records">

              <article class="card request-card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                  <h5 class="mb-0"><i class="ti-package mr-2"></i> {{data.records.item_name}}</h5>
                  <span class="badge badge-light p-2">#{{data.records.tracking_id}}</span>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="location-group">
                        <div class="location-icon from"><i class="ti-location-pin"></i></div>
                        <div>
                          <small class="text-muted">FROM</small>
                          <p class="font-weight-bold mb-0">{{data.records.pickup_city}}, {{data.records.pickup_state}}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2 text-center my-3 my-md-0">
                      <i class="ti-arrow-right text-muted" style="font-size: 1.5rem;">&#8358;{{data.records.totalamount}}</i>
                    </div>
                    <div class="col-md-5">
                      <div class="location-group">
                        <div class="location-icon to"><i class="ti-flag-alt"></i></div>
                        <div>
                          <small class="text-muted">TO</small>
                          <p class="font-weight-bold mb-0">{{data.records.receiver_city}}, {{data.records.receiver_state}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <div class="status-group">
                    <strong class="mr-2">Status:</strong>
                    <span :class="getPickupStatusClass(data.records.pickup_status)">{{ statusPickUpText(data.records.pickup_status, data.records.driver_id) }}</span>
                  </div>
                  <div class="action-group" style="white-space: nowrap;">
                    <button @click="startPickup(data.records.id)" class="btn btn-xs btn-info" v-if="data.records.pickup_status == 1"><i class="ti-truck"></i> Start Journey</button>
                    <button  @click="endPickup(data.records.id)" class="btn btn-xs btn-success" v-if="data.records.pickup_status == 2 && data.records.payment_status == 1"><i class="ti-check-box"></i> End Journey</button>
                    <button @click="confirmPayment(data.records.id)" class="btn btn-xs btn-outline-success" v-if="data.records.pickup_status != 0 && data.records.payment_status == 0"><i class="ti-money"></i> Confirm Payment</button>
                  </div>
                </div>
              </article>
            </div>
                    <div v-if="paginate" class="mt-4">
                        <pagination @changepage="changepage" v-model="currentpage" :total-items="totalrecords" :items-per-page="pagelimit" :show-page-count="true" :show-page-limit="true" @limit-changed="limitChanged"></pagination>
                    </div>
          </div>
          <div class="row justify-content-center" v-else>
            <div class="col-sm-12 text-center py-5">
              <div class="empty-state-card">
                <h3 class="mt-3">No Available Requests</h3>
                <p class="text-muted">You're all caught up! Stay online to see new requests as they come in.</p>

              </div>
            </div>
          </div>
        </div>
      </section>

    <?php } ?>
  </div>
</template>

<style scoped>
  .page-header {
    margin-top: 100px;
    padding: 80px 0;
    text-align: center;
    border-bottom: 1px solid #dee2e6;
    background-color: #FFFFFF;
    background-image: radial-gradient(#28a745 1.1px, transparent 1.1px), radial-gradient(#28a745 1.1px, #FFFFFF 1.1px);
    background-size: 44px 44px;
    background-position: 0 0, 22px 22px;
  }

  .page-title {
    font-weight: 800;
    font-size: 4rem;
  }

  .page-subtitle {
    font-size: 1.1rem;
    color: #6c757d;
    max-width: 600px;
    margin: 0 auto;
  }

  .search-bar-container {
    display: flex;
    background-color: #fff;
    border-radius: 50px;
    padding: 5px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  }

  .search-input {
    border: none;
    padding: 10px 20px;
    flex-grow: 1;
    border-radius: 50px;
    outline: none;
  }

  .search-button {
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 10px 30px;
    font-weight: 600;
  }

  .widget-title {
    font-weight: 700;
    margin-bottom: 2rem;
  }

  .request-card {
    border: 1px solid #e9ecef;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
  }

  .request-card:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    transform: translateY(-5px);
  }

  .request-card .card-header {
    border-bottom: 1px solid #e9ecef;
  }

  .request-card .card-header h5 {
    font-weight: 600;
    font-size: 1.1rem;
  }

  .request-card .location-group {
    display: flex;
    align-items: center;
  }

  .request-card .location-icon {
    font-size: 1.5rem;
    margin-right: 15px;
    width: 30px;
    text-align: center;
  }

  .request-card .location-icon.from {
    color: #28a745;
  }

  .request-card .location-icon.to {
    color: #dc3545;
  }

  .request-card .card-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #e9ecef;
  }
</style>
<script>
  var TrackitemsListComponent = Vue.component('trackitemsList', {
    template: '#trackitemsList',
    mixins: [ListPageMixin],
    props: {
      limit: {
        type: Number,
        default: defaultPageLimit,
      },
      pagename: {
        type: String,
        default: 'trackitems',
      },
      routename: {
        type: String,
        default: 'trackitemslist',
      },
      apipath: {
        type: String,
        default: 'trackitems/list',
      },
      tablestyle: {
        type: String,
        default: ' table-striped table-sm',
      },
    },
    data: function() {
      return {
        pagelimit: defaultPageLimit,
        user: {
          request_id: '',
          payer: '',
          picture: '',
          payment_method: '',
        },
        payment_methodOptionList: ["Cash", "Transfer", "POS", "ATM", "QRCODE"],
        driver_status: 1,
        paymentsinfo: '',
        reviewcomment: '',
        reviewid: '',
        selectedStars: 0
      }
    },
    computed: {
      pageTitle: function() {
        return 'Trackitems';
      },
      filterGroupChange: function() {
        return;
      },
    },
    watch: {},
    methods: {
      showPopOpenPaymentModal: function(data) {
        //alert(img)
        //this.modalimage = img
        this.user.request_id = data.id;
        this.user.payer = "requester";
        $('#openPaymentModal').modal();
      },
      submitPayment: function(e) {
        var payload = this.user;
        this.loading = true;
        var self = this;
        var apiurl = setApiUrl('Payments/add');
        this.$http.post(apiurl, payload, {
          emulateJSON: true
        }).then(function(response) {
            self.loading = false;
            //window.location = response.body;
            this.user = {
              request_id: '',
              payer: '',
              picture: '',
              payment_method: '',
            };
            this.$validator.reset();
            this.load();
            $('#openPaymentModal').modal("hide");
            //location.reload();

          },
          function(response) {
            this.loading = false;
            this.showError = false
            this.errorMsg = response.statusText;
            //Flashes messages
            setTimeout(function() {
              self.showError = true;
            }, 100);
          });
      },
      load: function() {
        this.records = [];
        if (this.loading == false) {
          this.ready = false;
          this.loading = true;
          var url = this.apiUrl;
          this.$http.get(url).then(function(response) {
              var data = response.body;
              if (data && data.records) {
                this.totalrecords = data.total_records;
                if (this.pagelimit > data.records.length) {
                  this.loadcompleted = true;
                }
                this.records = data.records;
                this.driver_status = data.driver_status;
              } else {
                this.$root.$emit('requestError', response);
              }
              this.loading = false
              this.ready = true
            },
            function(response) {
              this.loading = false;
              this.$root.$emit('requestError', response);
            });
        }
      },
      filterGroup: function() {
        var filters = {};
        this.filterMsgs = [];
        this.filter(filters);
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
            $('#openPaymentInfoModal').modal("hide");
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
        //alert(img)
        //this.modalimage = img
        this.reviewid = id;
        //this.user.payer = "requester";
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
        //var payload = this.message;
        console.log(this.reviewid + " " + this.reviewcomment + " " + this.selectedStars)
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
              this.load()
              $('#openReviewModal').modal("hide");
            },
            function(response) {
              console.log(response)
              $('#openReviewModal').modal("hide");
              //Flashes messages
              setTimeout(function() {
                self.showError = false;
              }, 100);
            });
        }
      },
            statusPickUpText(status, driver_id) {
                switch (String(status)) {
                    case '0':
                        if (driver_id == null || driver_id === '' || driver_id === 0) {
                            return 'Pending Assignment';
                        } else {
                            return 'Pending Rider Pickup';
                        }
                    case '1':
                        return 'Rider Pickup Accepted';
                    case '2':
                        return 'In Transit';
                    case '3':
                        return 'Delivered';
                    default:
                        return 'Unknown';
                }
            },
            getPickupStatusClass(status) {
                switch (String(status)) {
                    case '0':
                        return 'badge-warning';
                    case '1':
                        return 'badge-primary';
                    case '2':
                        return 'badge-info';
                    case '3':
                        return 'badge-success';
                    default:
                        return 'badge-secondary';
                }
            },

    },

  });
</script>