<template id="paymentsList">
  <section class="page-component">
    <div>
      <section class="page-header">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
              <h1 class="page-title">Payment History</h1>
              <p class="page-subtitle">Search by Tracking ID or browse your full history of payments below.</p>
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
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5">
                      <a :href="data.picture" target="_blank" title="View Proof of Payment">
                        <img class="img-fluid rounded" :src="data.picture" style="height: 150px; width: 100%; object-fit: cover;">
                      </a>
                    </div>
                    <div class="col-lg-8 col-md-7 mt-3 mt-md-0">
                      <h5 class="mb-1">{{data.item_name}}</h5>
                      <p class="text-muted small mb-2">#{{data.tracking_id}}</p>
                      <ul class="list-unstyled small">
                        <li><i class="ti-user mr-2"></i> {{data.firstname}} {{data.lastname}}</li>
                        <li><i class="ti-calendar mr-2"></i> {{data.created_at}}</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <div class="status-group">
                    <strong class="mr-2">Status:</strong>
                    <span v-if="data.payment_status == 0">Confirmation Pending</span>
                    <span v-if="data.payment_status == 1">Payment Confirmed</span>
                  </div>
                  <!--<div class="action-group">
                    <router-link :to="'/payments/view/' + data.id" class="btn btn-xs btn-outline-primary"><i class="ti-eye"></i> View</router-link>
                  </div>-->
                </div>
              </article>
            </div>

            <ul class="pagination justify-content-center" v-if="totalpage > 1">
              <li class="page-item" :class="{ disabled: currentpage == 1 }">
                <a @click.prevent="changePage(currentpage - 1)" class="page-link" href="#">&laquo;</a>
              </li>
              <li class="page-item" :class="{ active: page == currentpage }" v-for="(page, index) in totalpage" :key="index">
                <a @click.prevent="changePage(page)" class="page-link" href="#">{{ page }}</a>
              </li>
              <li class="page-item" :class="{ disabled: currentpage == totalpage }">
                <a @click.prevent="changePage(currentpage + 1)" class="page-link" href="#">&raquo;</a>
              </li>
            </ul>

          </div>
          <div class="row justify-content-center" v-else>
            <div class="col-sm-12 text-center py-5">
              <div class="empty-state-card">
                <div class="icon-circle mb-3" style="background-color: #f0f0f0;"><i class="ti-receipt" style="color: #aaa;"></i></div>
                <h3 class="mt-3">No Payment Records Found</h3>
                <p class="text-muted">Your payment history will appear here once payments are made.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
</template>

<script>
  var PaymentsListComponent = Vue.component('paymentsList', {
    template: '#paymentsList',
    mixins: [ListPageMixin],
    props: {
      limit: {
        type: Number,
        default: defaultPageLimit,
      },
      pagename: {
        type: String,
        default: 'payments',
      },
      routename: {
        type: String,
        default: 'paymentslist',
      },
      apipath: {
        type: String,
        default: 'payments/list',
      },
      tablestyle: {
        type: String,
        default: ' table-striped table-sm',
      },
    },
    data: function() {
      return {
        pagelimit: 5, // Set to display 5 items per page
      }
    },
    computed: {
      pageTitle: function() {
        return 'Payments';
      },
      filterGroupChange: function() {
        return;
      },
    },
    watch: {
      allSelected: function() {
        this.selected = [];
        if (this.allSelected == true) {
          for (var i in this.records) {
            var id = this.records[i].id;
            this.selected.push(id);
          }
        }
      }
    },
    methods: {
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
              } else {
                this.$root.$emit('requestError', response);
              }
              this.loading = false
              this.ready = true
              this.totalpage = Math.ceil(this.totalrecords / this.pagelimit);
            },
            function(response) {
              this.loading = false;
              this.$root.$emit('requestError', response);
              this.totalpage = Math.ceil(this.totalrecords / this.pagelimit);
              this.currentpage = 1;
            });
        }
      },
      filterGroup: function() {
        var filters = {};
        this.filterMsgs = [];
        this.filter(filters);
      },
    }
  });
</script>

<style scoped>
  .page-header {
    padding: 80px 0;
    text-align: center;
    border-bottom: 1px solid #dee2e6;
    background-color: #FFFFFF;
    background-image: radial-gradient(#28a745 1.1px, transparent 1.1px), radial-gradient(#28a745 1.1px, #FFFFFF 1.1px);
    background-size: 44px 44px;
    background-position: 0 0, 22px 22px;
    margin-top: 50px;
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

  .request-card {
    border: 1px solid #e9ecef;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
  }

  .request-card:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    transform: translateY(-5px);
  }

  .request-card .card-header h5 {
    font-weight: 600;
    font-size: 1.1rem;
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

  .empty-state-card .icon-circle {
    width: 90px;
    height: 90px;
    font-size: 3rem;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 20px;
  }
</style>