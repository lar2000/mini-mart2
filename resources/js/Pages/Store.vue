<template>
  <div>
    <storewedgit />
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between">
          <h4 class="card-title mg-b-0">STRIPED ROWS</h4>
          <span>
       
            
           <!-- <button
              class="btn btn-primary-gradient"
              @click="get_data()"
            >
              ດຶງຂໍ້ມູນ
            </button>
          -->
            <button
              v-if="FormShow"
              class="btn btn-success-gradient me-2"
              @click="save_data()"
            >
              ບັນທຶກ
            </button>
            <button
              v-if="FormShow"
              class="btn btn-danger-gradient"
              @click="close_form()"
            >
              ຍົກເລີກ
            </button>

            <button
              v-if="!FormShow"
              class="btn btn-primary-gradient"
              @click="add_store()"
            >
              ເພີ່ມໃໝ່
            </button>
          </span>
        </div>
        <p class="tx-12 tx-gray-500 mb-2">
          Example of Valex Striped Rows.. <a href="">Learn more</a>
        </p>
      </div>
      <div class="card-body">
    
      
        <div class="form-store row" v-if="FormShow">
          <div class="col-md-3">ອັບໂຫຼດຮູບ</div>
          <div class="col-md-9">
       
            <div class="form-group">
              <label for="exampleInputEmail1">ຊື່ສິນຄ້າ</label>
              <input
                type="text"
                class="form-control"
                v-model="FormProduct.name"
                placeholder="ປ້ອນຊື່ສິນຄ້າ..."
              />
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">ຈຳນວນ</label>
              <input
                type="number"
                class="form-control"
                v-model="FormProduct.amount"
                placeholder="ປ້ອນຈຳນວນ..."
              />
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">ລາຄາຊື້</label>
                <cleave
                  :options="options"
                  class="form-control"
                  v-model="FormProduct.price_buy"
                  placeholder="ປ້ອນລາຄາຊື້..."
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">ລາຄາຂາຍ</label>
                <cleave
                :options="options"
                  class="form-control"
                  v-model="FormProduct.price_sell"
                  placeholder="ປ້ອນລາຄາຂາຍ.."
                />
              </div>
            </div>
          </div>
          </div>
          
        </div>
      </div>

      <div class="table-responsive" v-if="!FormShow">
        <table class="table table-striped mg-b-0 text-md-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>ຊື່ສິນຄ້າ</th>
              <th>ຈຳນວນ</th>
              <th>ລາຄາຊື້</th>
              <th>ລາຄາຂາຍ</th>
              <th>ຈັດການ</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="list in FormData" :key="list.id">
              <th>{{ list.id }}</th>
              <td>{{ list.name }}</td>
              <td>{{ list.amount }}</td>
              <td>{{ formatPrice(list.price_buy) }}</td>
              <td>{{ formatPrice(list.price_sell) }}</td>
              <td>
                <div class="btn-icon-list">
                  <button class="btn btn-primary btn-icon" @click="edit_store(list.id)">
                    <i class="fe fe-edit"></i>
                  </button>
                  <button class="btn btn-danger btn-icon" @click="delete_store(list.id)">
                    <i class="fe fe-trash-2"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- bd -->
    </div>
    <!-- bd -->
  </div>
  <!-- bd -->
</template>

<script>
export default {
  name: "MiniPosStore",

  data() {
    return {
      options: {
              ///prefix: '₭ ',
              numeral: true,
              numeralPositiveOnly: true,
              noImmediatePrefix: true,
              rawValueTrimPrefix: true,
              numeralIntegerScale: 10,
              numeralDecimalScale: 2,
              numeralDecimalMark: '.',
              delimiter: ','
                },
      FormShow: false,
      FormType: false,
      EditID:"",
      FormData: [],
      FormProduct: {
        name: "",
        amount: "",
        price_buy: "",
        price_sell: "",
      },
    };
  },

  methods: {
    formatPrice(value) {
			let val = (value / 1).toFixed(0).replace(",", ".");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		},
    get_data(){
      this.$axios.get('/api/store').then((response)=>{
            console.log(response.data);
            this.FormData = response.data;
            }).catch((error)=>{
                console.log(error)
            });
    },
    add_store() {
      this.FormShow = true;
    },
    edit_store(id){

        this.FormType = true;

        // ເກັບ ໄອດີ ທີ່ຈະທຳການອັບເດດ
        this.EditID = id;

        // ຄົ້ນຫາຂໍ້ມູນໂດຍທຽບກັບ id
        //let item = this.FormData.find((i)=>i.id == id);

        // ທຳການເປີດຟອມ
        this.FormShow = true;

        // ເພີ່ມຂໍ້ມູນເຂົ້າໃນຟອມ
        //this.FormProduct.name = item.name;
        //this.FormProduct.amount = item.amount;
        //this.FormProduct.price_buy = item.price_buy;
        //this.FormProduct.price_sell = item.price_sell;

        this.$axios.get(`/api/store/edit/${id}`).then((response) => {
	
          this.FormProduct.name = response.data.name;
          this.FormProduct.amount = response.data.amount;
          this.FormProduct.price_buy = response.data.price_buy;
          this.FormProduct.price_sell = response.data.price_sell;

        }).catch((error) => {
            console.log(error);
        });

    },
    delete_store(id){

        //let index = this.FormData.map((i)=>i.id).indexOf(id);
        //this.FormData.splice(index,1);

        this.$axios.delete(`/api/store/delete/${id}`).then((response)=>{
              if(response.data.success){
                    this.get_data();
                    alert(response.data.message);
              } else {
                  alert('ລຶບຂໍ້ມູນ ບໍ່ສຳເລັດ:' + response.data.message);
              }
              
            }).catch((error)=>{
                console.log(error)
            });
    },
    save_data() {

        if(!this.FormType){
            // ເພີ່ມຂໍ້ມູນ ເຂົ້າໃນ FormData
            /*this.FormData.push({
                id: Math.floor(Math.random() * 1000),
                name: this.FormProduct.name,
                amount: this.FormProduct.amount,
                price_buy: this.FormProduct.price_buy,
                price_sell: this.FormProduct.price_sell,
            });*/

            // ເພີ່ມຂໍ້ມູນເຂົ້າຖານຂໍ້ມູນ
            let formData = new FormData();
            formData.append('name', this.FormProduct.name);
            formData.append('amount', this.FormProduct.amount);
            formData.append('price_buy', this.FormProduct.price_buy);
            formData.append('price_sell', this.FormProduct.price_sell);

            this.$axios.post("/api/store/add", formData).then((response)=>{
              this.get_data();
            }).catch((error)=>{
                console.log(error)
            });
 
        } else {
            // ອັບເດດຂໍ້ມູນ

            //this.FormData.find((i)=>i.id == this.EditID).name = this.FormProduct.name;
            //this.FormData.find((i)=>i.id == this.EditID).amount = this.FormProduct.amount;
            //this.FormData.find((i)=>i.id == this.EditID).price_buy = this.FormProduct.price_buy;
            //this.FormData.find((i)=>i.id == this.EditID).price_sell = this.FormProduct.price_sell;

            let formData = new FormData();
            formData.append('name', this.FormProduct.name);
            formData.append('amount', this.FormProduct.amount);
            formData.append('price_buy', this.FormProduct.price_buy);
            formData.append('price_sell', this.FormProduct.price_sell);
            
            this.$axios.post(`/api/store/update/${this.EditID}`, formData).then((response)=>{
              if(response.data.success){
                    this.get_data();
                    alert(response.data.message);
              } else {
                  alert('ອັບເດດຂໍ້ມູນ ບໍ່ສຳເລັດ:' + response.data.message);
              }
              
            }).catch((error)=>{
                console.log(error)
            });
        }

        this.FormType = false;
      

      // ລ້າງຂໍ້ມູນໃນຟອມ
      this.FormProduct.name = "";
      this.FormProduct.amount = "";
      this.FormProduct.price_buy = "";
      this.FormProduct.price_sell = "";

      // ສະແດງລາຍການສິນຄ້າ
      this.FormShow = false;
    },
    close_form() {
      this.FormShow = false;
    },
  },
  created(){
    this.get_data();
  }
};
</script>

<style lang="scss" scoped>
</style>