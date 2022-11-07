<template>
    <div>
        
        <div class="container-fluid">
          <div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
						  <p class="mg-b-0">Sales monitoring dashboard template.</p>
						</div>
					</div>
					<div class="main-dashboard-header-right">
						<div>
							<label class="tx-13">Customer Ratings</label>
							<div class="main-star">
								<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
							</div>
						</div>
						<div>
							<label class="tx-13">Online Sales</label>
							<h5>563,275</h5>
						</div>
						<div>
							<label class="tx-13">Offline Sales</label>
							<h5>783,675</h5>
						</div>
					</div>
				</div>
          <storewedgit/>
           <div class="row">
				<div class="col-md-8">
					<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">ສະຫຼຸບລາຍຮັບ-ລາຍຈ່າຍ</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<div class="row justify-content-end">
									<div aria-label="Basic example" class="btn-group" role="group" style="width:200px">
														<button class="btn btn-secondary pd-x-25" type="button" @click="month_type = 'm'" > <i class="las la-angle-double-right" v-if="month_type=='m'"></i> ເດືອນ</button> 
														<button class="btn btn-secondary pd-x-25" type="button" @click="month_type = 'y'" > <i class="las la-angle-double-right" v-if="month_type=='y'"></i> ປີ</button>
													</div>
													<input type="date" class="form-control  me-2" style="width:180px" v-model="dmy" >
													<button class="btn btn-primary me-3" style="width:180px" @click="CreateReport()" >ສະແດງລາຍງານ</button>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive"> 
									<!-- <BarChartEx/> -->
									<LineChart
									:chartData="chdat"
									:chartOptions="chdatatop"
									:update="update_chart"
									:key="key"
									v-if="ShowChart"
									/>
									
								</div>
							</div>
						</div>
				</div>
				<div class="col-md-4" >
					<div class="col-12">
						<div class="card bg-primary-gradient text-white ">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="icon1 mt-2 text-center">
											<i class="fe fe-users tx-40"></i>
										</div>
									</div>
									<div class="col-6">
										<div class="mt-0 text-center">
											<span class="text-white">Members</span>
											<h2 class="text-white mb-0">600</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card bg-danger-gradient text-white ">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="icon1 mt-2 text-center">
											<i class="fe fe-users tx-40"></i>
										</div>
									</div>
									<div class="col-6">
										<div class="mt-0 text-center">
											<span class="text-white">Members</span>
											<h2 class="text-white mb-0">600</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card bg-success-gradient text-white ">
							<div class="card-body">
								<div class="row">
									<div class="col-6">
										<div class="icon1 mt-2 text-center">
											<i class="fe fe-users tx-40"></i>
										</div>
									</div>
									<div class="col-6">
										<div class="mt-0 text-center">
											<span class="text-white">Members</span>
											<h2 class="text-white mb-0">600</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		   </div>
        </div>
        
    </div>
</template>

<script>

import { defineComponent } from 'vue'
import BarChartEx from '../components/BarChartEx.vue'
import LineChart from '../components/LineChart.vue'

export default defineComponent({
    name: 'MiniPosReport',

    data() {
        return {
            month_type:'y',
			data_income:[],
			data_expense:[],
			dmy:'',
			ShowChart:false,
			key:0,
			update_chart:null,
			chdata:[],
			chdatatop:{
                 responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                    yAxes: [
                        {
                        ticks: {
                            display: true,
                            beginAtZero: false,
                            callback: function (value, index, values) {
                            return ( Number(value) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                            },
                        },
                        gridLines: {
                            show: true,
                        },
                        },
                    ],
                    },
                    tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                        return (
                            Number(tooltipItem.yLabel) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                        },
                    },
                    mode: "index",
                    intersect: false,
                    },
            },

        };
    },
	components:{
		BarChartEx,LineChart
	},
    mounted() {
        
    },

    methods: {

		CreateReport(){
		this.$axios.get("/sanctum/csrf-cookie").then((response) => {
			this.$axios.post("/api/report", {
			month_type: this.month_type,
			dmy: this.dmy,
			})
			.then((response) => {
				this.data_income = response.data.income;
				this.data_expense = response.data.expense;
				this.GenGrap();
			})
			.catch((error) => {
				this.loading = false;
			});
		});
		},
		GenGrap(){

		}

        
    },
    beforeRouteEnter(to, from, next) {
    //console.log(window.Laravel.isLoggedin);
		//window.Laravel.urlpath = to.name
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/login";
    }
    next();
  },
});
</script>

<style lang="scss" scoped>

</style>