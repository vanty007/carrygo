<template id="Home">
  <div>

    <?php if (ROLE_ID == "user") { ?>

      <div id="openPaymentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pay for this Pick Up</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="display: grid;justify-content: center;align-items: center;">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <section class="hero-section">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 hero-content order-2 order-lg-1 text-center text-lg-left">
              <p class="welcome-text">Welcome to Your Dashboard <?php echo get_session('user_data')['firstname']; ?>!</p>
              <h1 class="hero-headline">
                Fastest Delivery <br />
                <span class="highlight-text">Easy Pickup</span>
              </h1>
              <p class="hero-subheadline">
                Quickly request a new pickup or track an existing delivery. Fast, simple, and reliable service right here in Jos.
              </p>
              <div class="mt-4">
                <router-link to="/pickup_request/add" class="btn btn-primary btn-lg px-5 py-3">Request a New Pickup</router-link>
              </div>
            </div>
            <div class="col-lg-6 hero-image-container order-1 order-lg-2 mb-5 mb-lg-0">
              <div class="delivery-illustration">
                <img src="assets/images/hero-user1.png" alt="Delivery Illustration" class="img-fluid" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="how-it-work-section py-5">
        <div class="custom-shape-divider-bottom-1760106560">
          <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
          </svg>
        </div>
        <div class="container">
          <h2 class="text-center mb-5">How It Works</h2>
          <div class="row text-center">
            <div class="col-md-4 col-sm-12 mb-4">
              <div class="how-it-work-item">
                <div class="icon-circle mb-3"><i class="ti-pencil-alt"></i></div>
                <h4>1. Make a Request</h4>
                <p class="text-muted">Fill in your pickup and delivery details in our simple form.</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
              <div class="how-it-work-item">
                <div class="icon-circle mb-3"><i class="ti-truck"></i></div>
                <h4>2. Rider Dispatched</h4>
                <p class="text-muted">A nearby rider is assigned and heads to your location for pickup.</p>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-4">
              <div class="how-it-work-item">
                <div class="icon-circle mb-3"><i class="ti-map-alt"></i></div>
                <h4>3. Track Your Item</h4>
                <p class="text-muted">Follow your delivery in real-time until it safely reaches its destination.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-sm" style="background-color: #f7f9fc;">
        <div class="container">
          <div class="widget">
            <h4 class="widget-title">Active Requests</h4>
            <div v-if="records.length">
              <div v-for="(data,index) in records">
                <article class="card request-card mb-4" v-if="(data.records.pickup_status == 0 || data.records.pickup_status == 1)">
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
                    <div v-if="paginate" class="mt-4">
                        <pagination @changepage="changepage" v-model="currentpage" :total-items="totalrecords" :items-per-page="pagelimit" :show-page-count="true" :show-page-limit="true" @limit-changed="limitChanged"></pagination>
                    </div>
            </div>
            <div class="row justify-content-center" v-else>
              <div class="col-sm-12 text-center py-5">
                <div class="empty-state-card">
                  <div class="icon-circle mb-3" style="background-color: #f0f0f0;"><i class="ti-dropbox" style="color: #aaa;"></i></div>
                  <h3 class="mt-3">No Active Requests Found</h3>
                  <p class="text-muted">Ready to send something? Click the button in the banner above!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    <?php } else if (ROLE_ID == "driver") { ?>

      <div id="openPaymentInfoModal" class="modal fade" role="dialog"></div>

      <section class="hero-section">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 hero-content order-2 order-lg-1 text-center text-lg-left">
              <p class="welcome-text">Hello <?php echo get_session('user_data')['firstname']; ?>!</p>
              <h1 class="hero-headline">
                Ready For Your <br />
                <span class="highlight-text">Next Pickup?</span>
              </h1>
              <p class="hero-subheadline">
                Toggle your status to start receiving new pickup requests. Your available jobs will appear below.
              </p>
              <div class="mt-4">
                <button @click="driverStatus(2)" class="btn btn-danger btn-lg px-5 py-3" v-if="driver_status==1">
                  <i class="ti-na"></i> Go Offline
                </button>
                <button @click="driverStatus(1)" class="btn btn-success btn-lg px-5 py-3" v-if="driver_status==2">
                  <i class="ti-control-play"></i> Go Online
                </button>
              </div>
            </div>
            <div class="col-lg-6 hero-image-container order-1 order-lg-2 mb-5 mb-lg-0">
              <div class="delivery-illustration">
                <img src="assets/images/hero-driver1.png" alt="Rider Illustration" class="img-fluid" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section-sm" style="background-color: #f7f9fc;">
        <div class="container">
          <div class="widget">
            <h4 class="widget-title">Available PickUp Requests</h4>
            <div v-if="records.length">
              <div v-for="(data,index) in records">
                <article class="card request-card mb-4" v-if="(data.records.pickup_status == 0 || data.records.pickup_status == 1) && driver_status==1 && data.records.driver_id == <?php echo USER_ID; ?>">
                  <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="ti-package mr-2"></i> {{data.records.item_name}}</h5>
                    <span class="badge badge-light p-2"><i class="ti-ruler-alt-2 mr-1"></i> {{data.records.distance}}</span>
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
                  <div class="card-footer text-right">
                    <div v-if="data.records.pickup_status == 0" class="btn-group w-100">
                      <button @click="rejectPickup(data.records.id)" class="btn btn-outline-danger w-50">Reject</button>
                      <button @click="acceptPickup(data.records.id)" class="btn btn-success w-50">Accept</button>
                    </div>
                    <div v-if="data.records.pickup_status == 1" class="btn-group w-100">
                      <button v-if="data.records.payment_status == 0" @click="confirmPayment(data.records.id)" class="btn btn-success w-50">Confirm Payment</button>
                      <button @click="startPickup(data.records.id)" class="btn btn-info w-50">Start Journey</button>
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
        </div>
      </section>

    <?php } ?>
  </div>
</template>

<script>
  var HomeComponent = Vue.component('HomeComponent', {
    template: '#Home',
    mixins: [ListPageMixin],
    props: {
      limit: {
        type: Number,
        default: defaultPageLimit,
      },
      pagename: {
        type: String,
        default: 'home',
      },
      routename: {
        type: String,
        default: 'home',
      },
      apipath: {
        type: String,
        default: 'home/index',
      },
      exportbutton: {
        type: Boolean,
        default: false,
      },
      importbutton: {
        type: Boolean,
        default: false,
      },
      tablestyle: {
        type: String,
        default: ' table-striped table-sm',
      },
    },
    data: function() {
      return {
        pagelimit: defaultPageLimit,
        loading: false,
        ready: false,
        user: {
          request_id: '',
          payer: '',
          picture: '',
          payment_method: '',
        },
        payment_methodOptionList: ["Cash", "Transfer", "POS", "ATM", "QRCODE"],
        driver_status: 1,
        paymentsinfo: '',
      }
    },
    computed: {
      pageTitle: function() {
        return 'Propertylist';
      },
      filterGroupChange: function() {
        return;
      },
    },
    watch: {
      allSelected: function() {
        //toggle selected record
        this.selected = [];
        if (this.allSelected == true) {
          for (var i in this.records) {
            var id = this.records[i].id;
            this.selected.push(id);
          }
        }
      },
    },
    methods: {
      showPopOpenPaymentModal: function(data) {
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
            this.user = {
              request_id: '',
              payer: '',
              picture: '',
              payment_method: '',
            };
            this.$validator.reset();
            this.load();
            $('#openPaymentModal').modal("hide");
          },
          function(response) {
            this.loading = false;
            this.showError = false
            this.errorMsg = response.statusText;
            setTimeout(function() {
              self.showError = true;
            }, 100);
          });
      },
      load: function() {
        this.records = [];
        this.test = [];
        if (this.loading == false) {
          this.ready = false;
          this.loading = true;
          var url = this.apiUrl;
          this.$http.get(url).then(function(response) {
              var data = response.body;
              console.log(data)
              if (data && data.records) {
                this.totalrecords = data.total_records;
                if (this.pagelimit > data.records.length) {
                  this.loadcompleted = true;
                }
                this.records = data.records;
                this.driver_status = data.driver_status;
              } else {
                console.log(response)
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
            this.load()
          },
          function(response) {
            console.log(response)
          });
      },
      driverStatus: function(id) {
        console.log("driver status change: "+id)
        var apiurl = setApiUrl('components/driverStatus/' + id);
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
    mounted: function() {
      this.ready = true;
    },
  });
</script>

<style scoped>
  /* Hero Section Styling */
  .hero-section {
    background-color: #fff;
    padding: 60px 0;
    position: relative;
    overflow: hidden;
  }

  .hero-section .container {
    position: relative;
    z-index: 1;
  }

  .hero-content .welcome-text {
    font-weight: 500;
    margin-bottom: 10px;
  }

  .hero-headline {
    font-size: 4rem;
    font-weight: 900;
    line-height: 1.2;
    color: #212529;
  }

  .hero-headline .highlight-text {
    color: #28a745;
  }

  .hero-subheadline {
    font-size: 1.1rem;
    color: #6c757d;
  }

  /* How It Works Section Styling */
  .how-it-work-section {
    margin-top: 100px;
    background-color: #4FD675;
    position: relative;
  }

  .how-it-work-section h2 {
    font-weight: 900;
    font-size: 3rem;
    color: #ffffff;
    padding-bottom: 25px;
  }

  .how-it-work-item .icon-circle {
    width: 90px;
    height: 90px;
    font-size: 3rem;
    background-color: #e8f5e9;
    color: #28a745;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 20px;
    transition: all 0.3s ease;
  }

  .how-it-work-item:hover .icon-circle {
    transform: scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }

  .how-it-work-item h4 {
    font-weight: 600;
    color: #fff;
    font-size: 1.5rem;
  }

  .how-it-work-item p.text-muted {
    color: #e8f5e9 !important;
  }

  /* SVG Shape Divider CSS */
  .custom-shape-divider-bottom-1760106560 {
    position: absolute;
    top: -100px;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
  }

  .custom-shape-divider-bottom-1760106560 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 150px;
  }

  .custom-shape-divider-bottom-1760106560 .shape-fill {
    fill: #4FD675;
  }

  /* New Styles for Request Cards */
  .widget-title {
    font-weight: 800;
    margin: 2rem 0;
    font-size: 2rem;
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

  .empty-state-card {
    background-color: #fff;
    border: 1px dashed #ced4da;
    border-radius: 15px;
    padding: 40px;
    max-width: 500px;
    margin: 0 auto;
  }

  /* Responsive adjustments */
  @media (max-width: 991.98px) {
    .hero-headline {
      font-size: 2.5rem;
    }

    .hero-section {
      padding-top: 40px;
      padding-bottom: 0;
    }

    .hero-image-container {
      text-align: center;
    }

    .delivery-illustration img {
      max-width: 350px;
    }
  }
</style>