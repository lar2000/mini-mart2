<template>
    <div>
        <div class="container-fluid">
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
            <div class="row">
				<div class="col-md-8">
					<div class="card">
                            <div class="card-body">
                                <input
									type="text"
									class="form-control"
									placeholder="ຄົ້ນຫາສິນຄ້າ..."
									v-model="search"
									@keyup.enter="get_data()"
								/>
                            </div>
                        </div>

						<div class="row row-sm" style="height:55vh; overflow:auto" >
								<div class="col-md-3 col-lg-3" v-for="list in FormData.data" :key="list.id">
									<div class="card pointer" @click="add_product(list.id)">
										<span v-for="li in ListOrder" :key="li.id">
											<span class="box-amount" v-if="list.id == li.id"> {{ li.order_amount }}</span>
										</span>
										
										<img alt="Image" class="img-fluid card-img-top" :src="url_img+'/assets/img/'+list.image" style=" width:100%; height:140px; object-fit:cover; object-position:center; ">
										<div class="card-body text-center ">
											<p class="card-text"> {{ list.name }} </p>
											<p class="card-text text-primary"> {{ formatPrice(list.price_sell) }} Kip</p>
										</div>
									</div>
								</div>
                 
                    
					
                			</div>
				</div>
				<div class="col-md-4">
					<div class="card">
                            <div class="card-body">
                               <div class="sam text-info d-flex justify-content-between mb-2">
									<span> <strong> ລວມຍອດເງິນ: </strong></span>
									<span> <strong> {{formatPrice(TotalAmount)}} Kip </strong></span>
							   </div>
							   <button class="btn btn-warning btn-block mb-4" @click="bt_pay()"> <i class="mdi mdi-currency-usd"></i> ຊຳລະເງິນ</button>
                            
							   <div class="table-responsive"
							 	style="height:50vh; overflow:auto"  
							   >

									<table class="table table-bordered mg-b-0 text-md-nowrap border">
										<thead>
											<tr>
												<th>ລາຍການ</th>
												<th>ລາຄາ</th>
												<th>ລວມຍອດ</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="item in ListOrder" :key="item.index">
												<th scope="row">{{item.name}}</th>
												<td>{{formatPrice(item.price_sell)}} <br> <i class="fe fe-minus-circle text-warning pointer" @click="remove_product(item.id)"></i> {{item.order_amount}} <i class="fe fe-plus-circle text-info pointer" @click="plus_product(item.id)"></i> | <i class="fe fe-trash-2 text-danger pointer" @click="delete_product(item.id)"></i></td>
												<td>{{ formatPrice(item.price_sell*item.order_amount) }}</td>
											</tr>
											
										</tbody>
									</table>
								</div>
							
							</div>

							

                        </div>
				</div>
			</div>
        </div>

		<div class="modal" id="modal_payment_box">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">ຊຳລະສີນຄ້າ</h6><button aria-label="Close" class="close"
							data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<h4 class="card-title text-info d-flex justify-content-between">  <span> <strong> ລວມຍອດເງິນ: </strong></span> <span><strong>{{formatPrice(TotalAmount)}} ກີບ</strong></span>  </h4>
                                               <h4 class="card-title text-info d-flex justify-content-between">  <span> <strong> ຮັບເງິນນຳລູກຄ້າ: </strong></span> <span><strong>{{formatPrice(CashAmount)}} ກີບ</strong></span>  </h4>
                                               <h4 class="card-title text-danger d-flex justify-content-between" v-if="CashBack>0">  <span> <strong> ເງິນທອນ: </strong></span> <span><strong>{{formatPrice(CashBack)}} ກີບ</strong></span>  </h4>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" v-model="CashAmount" style="text-align:right;" >
                                                    </div>
                                                 <div class="p-2 justify-content-center d-flex">
                                                        <div class="row" style="width:250px">
                                                        <div class="col-4 text-center  mt-2">
                                                            <a  class="btn btn-primary btn-lg text-white" @click="AddNum(1)" style="width:60px">1</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(2)" style="width:60px">2</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(3)" style="width:60px">3</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(4)" style="width:60px">4</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(5)" style="width:60px">5</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <button type="button" class="btn btn-primary btn-lg text-white" @click="AddNum(6)" style="width:60px">6</button>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(7)" style="width:60px">7</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(8)" style="width:60px">8</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(9)" style="width:60px">9</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum('00')" style="width:60px">00</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(0)" style="width:60px">0</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a  class="btn btn-danger btn-lg text-white" @click="AddNum('-')" style="width:60px"><i class="fas fa-long-arrow-alt-left"></i></a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center d-flex mt-2 text-center">
                                                        <button type="button" class="btn btn-success" @click="ConfirmPay()"  style="width:180px;" :disabled="CheckCPay"><i class="fas fa-coins"></i> ຍືນຍັນຊຳລ່ະເງິນ </button>
                                                    </div>
					</div>
					<div class="modal-footer">
					
						<button class="btn ripple btn-info" data-bs-dismiss="modal" type="button">ປິດ</button>
					</div>
				</div>
			</div>
		</div>
        
    </div>
</template>

<script>
export default {
    name: 'MINI-MART',

    data() {
        return {
			CashBack:'',
			CashAmount:'',
            FormData: [],
			ListOrder:[],
			search:'',
			url_img: window.location.origin,
        };
    },

    mounted() {
        
    },
	watch:{
    "search"(){
        if(this.search == ""){
          this.get_data();
        }
		}
	},
	computed:{
		CashBack(){
			return this.CashAmount-this.TotalAmount;
		},
		TotalAmount(){
			return this.ListOrder.reduce((num, item) => num + item.price_sell * item.order_amount,0);
		},
		CheckCPay(){
			if((this.CashAmount-this.TotalAmount)>=0){
				return false
			} else {
				return true
			}
		}
	},
    methods: {
		ConfirmPay(){
			
			this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
              this.$axios.post("/api/transection/add",{
				acc_type:'income',
				listorder: this.ListOrder
			  } ).then((response)=>{
				
				if(response.data.success){
					$("#modal_payment_box").modal("hide");
					this.search = '';
					this.ListOrder = [];
					this.CashAmount = '';
					this.get_data();
				}

              }).catch((error)=>{
                  console.log(error)
              });
            });

		},
		AddNum(num){
			console.log(num)
			if(num == '-'){
				this.CashAmount = this.CashAmount.slice(0,-1)
			} else {
					this.CashAmount = this.CashAmount + num;
			}

		},
		bt_pay(){

			$("#modal_payment_box").modal("show");
		},
		remove_product(id){
			if(this.ListOrder.find((i)=>i.id==id)){
				let old_order_amount = this.ListOrder.find((i)=>i.id==id).order_amount;
				if(old_order_amount-1>0){
					this.ListOrder.find((i)=>i.id==id).order_amount--;
				} else {
					this.ListOrder.splice(this.ListOrder.map(i=>i.id).indexOf(id),1);
				}
			}
		},
		plus_product(id){
			let item = this.FormData.data.find((i)=>i.id==id);
			let list_order = this.ListOrder.find((i)=>i.id==id);
			if(list_order){
				let old_order_amount = list_order.order_amount;
				if(item.amount - old_order_amount > 0){
					list_order.order_amount = old_order_amount+1;
				} else {
					this.$swal.fire(
                        'ຜິດຜາດ!',
                        'ສິນຄ້າໝົດ!',
                        'error'
                      );
				}

			} 

		},
		delete_product(id){
			this.ListOrder.splice(this.ListOrder.map(i=>i.id).indexOf(id),1);
		},
		add_product(id){
			let item = this.FormData.data.find((i)=>i.id==id);

			//console.log(item.amount)
			if(item.amount>0){

			
			let list_order = this.ListOrder.find((i)=>i.id==id);

			if(list_order){

			let old_order_amount = list_order.order_amount;

			if(item.amount - old_order_amount > 0){

				if(this.ListOrder.find((i)=>i.id==id)){

					this.ListOrder.find((i)=>i.id==id).order_amount++;

					} else {

						this.ListOrder.push({
						id: item.id,
						name: item.name,
						price_sell: item.price_sell,
						order_amount: 1
						});

					}
					} else {
						this.$swal.fire(
								'ຜິດຜາດ!',
								'ສິນຄ້າໝົດ!',
								'error'
							);
					}
				} else {
					if(this.ListOrder.find((i)=>i.id==id)){
					this.ListOrder.find((i)=>i.id==id).order_amount++;

						} else {

							this.ListOrder.push({
							id: item.id,
							name: item.name,
							price_sell: item.price_sell,
							order_amount: 1
							});

						}
				}
			// ຖ້າຈຳນວນສິນຄ້າເປັນ 0
			} else {
				this.$swal.fire('ຜິດຜາດ!','ສິນຄ້າໝົດ!','error');
			}
			

			
		},
		formatPrice(value) {
			let val = (value / 1).toFixed(0).replace(",", ".");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		},
        get_data(page){
  
		this.$axios.get("/sanctum/csrf-cookie").then((response)=>{
		  this.$axios.get(`/api/store?page=${page}&s=${this.search}`).then((response)=>{
				this.FormData = response.data;
			}).catch((error)=>{
				console.log(error)
			});
		});
			
},
    },
	
	created(){
		this.get_data();
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

<style >
	.box-amount{
		position: absolute; 
		background-color: crimson; 
		color: white;
		padding: 5px; 
		right: 0px; 
		border-bottom-left-radius: 15px;
	}

	.pointer{
		cursor: pointer;
	}
</style>