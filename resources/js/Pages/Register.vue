<template>
    <div :style="{'background-image':'url(assets/img/backgrounds/A4.jpg)'}">
        <div class="d-flex align-items-center py-2">
        <div class="container p-0">
								<div class="row">
									<div class="col-md-3 col-lg-3 col-xl-3 mx-auto">
										<div class="card-sigin">
											<div class="mb-5 d-flex">
												<a href="index.html"><img src="assets/img/brand/favicon.png" class="sign-favicon-a ht-40" alt="logo">
												<img src="assets/img/brand/favicon-white.png" class="sign-favicon-b ht-40" alt="logo">
												</a>
												<h1 class="main-logo1 ms-1 me-0 my-auto tx-28">Mi<span>ni</span>mart</h1>
											</div>
											<div class="main-signup-header">
												<h5 class="fw-normal mb-4">ລົງທະບຽນສະມາຊິກໃໝ່.</h5>
											
													<div class="form-group">
														<label class="tag tag-rounded">ຊື່ຜູ້ໃຊ້</label> 
                                                        <input class="form-control" placeholder="......" type="text" v-model="name">
													</div>
													<div class="form-group">
														<label class="tag tag-rounded">ອີເມວລ໌</label> <input class="form-control" placeholder="......" type="text" v-model="email">
													</div>
													<div class="form-group">
														<label class="tag tag-rounded">ລະຫັດຜ່ານ</label> <input class="form-control" placeholder="......" type="password" v-model="password">
													</div>
                                                    <div class="form-group">
														<label class="tag tag-rounded">ຍືນຍັນລະຫັດຜ່ານ</label> <input class="form-control" placeholder="......" type="password" v-model="password2">
													</div>
                                                    
                                                    <button class="btn btn-main-primary btn-block" @click="register()">ສ້າງບັນຊີຜູ້ໃຊ້</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-primary btn-block"><i class="fab fa-facebook-f"></i>Signup with Facebook</button>
                                                        </div>
                                                        
                                                        <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-light btn-block"><i class="g-signin2">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g>
                                                                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                                                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                                                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                                                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                                                    <path fill="none" d="M0 0h48v48H0z"></path></g></svg></i>Signup with Google</button>
                                                        </div>
                                                    </div>

                                                    <div class="alert alert-warning mt-4" role="alert" v-if="show_error">
																<button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
																	<span aria-hidden="true">×</span>
																</button>
																<strong>ຜິດຜາດ!</strong> {{text_error}}
															</div>
                                                <div class="main-signup-footer mt-5">
													<p style="color:black">ຫາກທ່ານມີບັນຊີແລ້ວ ກະລຸນາ => <router-link to="/login" >ເຂົ້າສູ່ລະບົບ</router-link></p>
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
    name: 'Register',

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