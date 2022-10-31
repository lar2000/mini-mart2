<template>
    <div>
        <div class="container p-0">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
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
														<label>ປ້ອນຊື່ຜູ້ໃຊ້</label> 
                                                        <input class="form-control" placeholder="..." type="text" v-model="name">
													</div>
													<div class="form-group">
														<label>Email</label> <input class="form-control" placeholder="..." type="text" v-model="email">
													</div>
													<div class="form-group">
														<label>ລະຫັດຜ່ານ</label> <input class="form-control" placeholder="..." type="password" v-model="password">
													</div>
                                                    <div class="form-group">
														<label>ຍືນຍັນລະຫັດຜ່ານ</label> <input class="form-control" placeholder="..." type="password" v-model="password2">
													</div>
                                                    
                                                    <button class="btn btn-main-primary btn-block" @click="register()">ສ້າງບັນຊີຜູ້ໃຊ້</button>
													
										
												<div class="main-signup-footer mt-5">
													<p>ມີບັນຊີແລ້ວ <a href="signin.html">ເຂົ້າສູ່ລະບົບ</a></p>
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
            text_error:''
        };
    },

    mounted() {
        
    },

    methods: {
        register(){
            this.$axios.post("/api/register",{
                name: this.name,
                email: this.email,
                password: this.password
            }).then((response)=>{
           
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