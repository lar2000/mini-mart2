<template>
    <div><div class="container-fluid">
      <div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">ສະບາຍດີ, ຍິນດີຕ້ອນຮັບ!</h2>
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
				<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">ການເຄື່ອນໄຫວ ທຸລະກຳ</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<div class="row justify-content-end">
									<div aria-label="Basic example" class="btn-group" role="group" style="width:200px">
														<button class="btn btn-secondary pd-x-25" type="button" @click="month_type = 'm'" > <i class="las la-angle-double-right" v-if="month_type=='m'"></i> ເດືອນ</button> 
														<button class="btn btn-secondary pd-x-25" type="button" @click="month_type = 'y'" > <i class="las la-angle-double-right" v-if="month_type=='y'"></i> ປີ</button>
													</div>
													<input type="date" class="form-control  me-2" style="width:180px" v-model="dmy" >
													<button class="btn btn-primary me-3" style="width:180px" @click="get_tran()">ສະແດງການເຄື່ອນໄຫວ</button>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive"> 
									<table class="table table-hover mb-0 text-md-nowrap border">
										<thead>
											<tr>
												<th class="p-2">ວັນທີ່</th>
												<th class="p-2">ເລກທີ່ທຸລະກຳ</th>
												<th class="p-2">ປະເພດທຸລະກຳ</th>
												<th class="p-2">ລາຍລະອຽດ</th>
												<th class="p-2 text-center">ມູນຄ່າ</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="list in TranData.data" :key="list.id">
												<th scope="row">{{ date(list.created_at)}}</th>
												<td>{{list.tran_id}}</td>
												<td>{{list.tran_type}}</td>
												<td>{{list.tran_detail}}</td>
												<td class=" text-right">{{formatPrice(list.price)}}</td>
											</tr>
											
										</tbody>
									</table>

									<pagination :pagination="TranData" :offset="4" @paginate="get_tran($event)"/>
								</div>
							</div>
						</div>
    </div>
       
    </div>
</template>

<script>

	import moment from "moment";

export default {
    name: 'Transection',

    data() {
        return {
            TranData:[],
			month_type:'y',
			dmy:''
        };
    },
	components:{
		moment
	},
    mounted() {
        
    },

    methods: {
		date(value){
			return moment(value).format("DD/MM/YYYY");
		},
		formatPrice(value) {
			let val = (value / 1).toFixed(0).replace(",", ".");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		},
        get_tran(page){
		this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
		  this.$axios.post(`/api/transection?page=${page}}`,{
			month_type: this.month_type,
			dmy: this.dmy
		  }).then((response)=>{
				this.TranData = response.data;
			}).catch((error)=>{
				console.log(error)
			});
		});
			
		},
    },
	created(){
		this.get_tran()
	},
    beforeRouteEnter(to, from, next) {
    //console.log(window.Laravel.isLoggedin);
		//window.Laravel.urlpath = to.name
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/login";
    }
    next();
  },
};
</script>

<style lang="scss" scoped>

</style>