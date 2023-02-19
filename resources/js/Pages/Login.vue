<template>
    <div :style="{'background-image':'url(assets/img/backgrounds/A4.jpg)'}">
        <div class="login d-flex align-items-center py-2">
							<!-- Demo content-->
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
											<div class="card-sigin">
												<div class="main-signup-header">
													<h2>ສະບາຍດີ!</h2>
													<h5 class="fw-semibold mb-4">ກະລຸນາປ້ອນອີເມວລ໌ ແລະ ລະຫັດເພື່ອເຂົ້າສູ່ ລະບົບ.</h5>
												
														<div class="form-group">
															<label class="tag tag-rounded">Email</label> 
															<input class="form-control" placeholder="ປ້ອນອີເມວລ໌" type="text" v-model="email">
														</div>
														<div class="form-group">
															<label class="tag tag-rounded">Password</label> <input class="form-control" placeholder="ປ້ອນລະຫັດຜ່ານ" type="password" v-model="password">
														</div>
														<div class="alert alert-warning" role="alert" v-if="show_error">
																<button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
																	<span aria-hidden="true">×</span>
																</button>
																<strong>ຜິດຜາດ!</strong> {{text_error}}
															</div>
														<button class="btn btn-main-primary btn-block" @click="login()">ເຂົ້າສູ່ລະບົບ</button>
													
											
													<div class="main-signin-footer mt-5">
											
														<p style="color:black">ບໍ່ທັນມີບັນຊີຜູ້ໃຊ້ກົດລີ້ງເພື່ອ =><router-link to="/register"> ລົງທະບຽນ</router-link></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
    </div>
</template>

<script>
export default {
    name: 'Login',

    data() {
        return {
            email:'',
			password:'',
			show_error:false,
			text_error:''
        };
    },

    mounted() {
        
    },

    methods: {
        login(){
			this.$axios.post("/api/login",{
                email: this.email,
                password: this.password
            }).then((response)=>{

				if(response.data.success){
					window.location.href = "/store"
					this.show_error = false
				} else {
					this.show_error = true
					this.text_error = response.data.message;
				}
           
            }).catch((error)=>{
                console.log(error)
            });
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
