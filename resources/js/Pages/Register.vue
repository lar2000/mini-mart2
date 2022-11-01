<template>
    <div>
        <div class="d-flex align-items-center py-2">
        <div class="container p-0">
								<div class="row">
									<div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
										<div class="card-sigin">
											<div class="mb-5 d-flex">
												<a href="index.html"><img src="assets/img/brand/favicon.png" class="sign-favicon-a ht-40" alt="logo">
												<img src="assets/img/brand/favicon-white.png" class="sign-favicon-b ht-40" alt="logo">
												</a>
												<h1 class="main-logo1 ms-1 me-0 my-auto tx-28">Va<span>le</span>x</h1>
											</div>
											<div class="main-signup-header">
												<h5 class="fw-normal mb-4">ລົງທະບຽນສະມາຊິກໃໝ່.</h5>
											
													<div class="form-group">
														<label>ຊື່ຜູ້ໃຊ້</label> 
                                                        <input class="form-control" placeholder="..." type="text" v-model="name">
													</div>
													<div class="form-group">
														<label>ອີເມວລ໌</label> <input class="form-control" placeholder="..." type="text" v-model="email">
													</div>
													<div class="form-group">
														<label>ລະຫັດຜ່ານ</label> <input class="form-control" placeholder="..." type="password" v-model="password">
													</div>
                                                    <div class="form-group">
														<label>ຍືນຍັນລະຫັດຜ່ານ</label> <input class="form-control" placeholder="..." type="password" v-model="password2">
													</div>
                                                    
                                                    <button class="btn btn-main-primary btn-block" @click="register()">ສ້າງບັນຊີຜູ້ໃຊ້</button>

                                                    <div class="alert alert-warning mt-4" role="alert" v-if="show_error">
																<button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
																	<span aria-hidden="true">×</span>
																</button>
																<strong>ຜິດຜາດ!</strong> {{text_error}}
															</div>
													
										
												<div class="main-signup-footer mt-5">
													<p>ຫາກທ່ານມີບັນຊີແລ້ວ ກະລຸນາ <router-link to="/login" >ເຂົ້າສູ່ລະບົບ</router-link></p>
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
export default {
    name: 'Minipos04Register',

    data() {
        return {
            name:'',
            email:'',
            password:'',
            password2:'',
            show_error:false,
            text_error:'',
           
        };
    },

    mounted() {
        
    },

    methods: {
        register(){


            if(this.name == '' || this.email == '' || this.password == ''){
                this.show_error = true
                this.text_error = " ກະລຸນາກວດຊອບ ປ້ອນຂໍ້ມູນໃຫ້ຄົບຖ້ວນ! "
            } else{
                if(this.password2 !='' && this.password == this.password2){

                    this.show_error = false
                    this.text_error = ""

                    this.$axios.post("/api/register",{
                        name: this.name,
                        email: this.email,
                        password: this.password
                    }).then((response)=>{
                        if(response.data.success){
                            this.$router.push('login');
                        } else {
                            this.$swal.fire(
                                'ຜິດຜາດ!',
                                response.data.message,
                                'error'
                            );
                        }
                    }).catch((error)=>{
                        console.log(error)
                    });

                } else {
                    this.show_error = true
                    this.text_error = " ລະຫັດຜ່ານບໍ່ກົງກັນ ກະລຸນາກວດຄຶນ! "
                }

            }


        }
    },
    beforeRouteEnter(to, from, next) {
		if (window.Laravel.isLoggedin) {
		window.location.href = "/store";
		}
    next();
  },
};
</script>

<style lang="scss" scoped>

</style>