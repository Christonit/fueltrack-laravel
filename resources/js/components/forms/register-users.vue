<template>
    <form class="float-center" method="POST"  name="new-user" ref='new-user'>

        <!--@csrf-->

        <slot name="csrf"></slot>


        <div id="signup-user-details" class="">


            <label>Username

                <input id="username" type="text" class="" name="username" value="" required @keyup="validateUsername">

                <span class="callout error " v-if="username.errors ">{{ username.errors[0] }}</span>


            </label>

            <label>Email

                <input id="email" type="email" class="" name="email" value="" required @keyup="validateEmail">
                <span class="callout error " v-if="email.errors ">{{ email.errors[0] }}</span>


            </label>

            <label>Password

                <input id="password" type="password" class="" name="password" ref="password" required @keyup="validatePassword">
                <span class="callout error " v-if="password.errors ">{{ password.errors[0] }}</span>


            </label>

            <label v-if="password =='success'">Confirm password

                <input id="password-confirm" type="password" class="form-control" ref="passwordConfirm" name="password_confirmation" required @keyup="confirmPassword" value="">
                <span class="callout error " v-if="!passwordCheck">Password doesn't match.</span>


            </label>

            <button type="submit" class="button expanded success">
                Submit
            </button>

        </div>

    </form>
</template>

<script>
    export default {
        name: "register-users-form",
        data(){
            return {
                username: '',
                email:'',
                password:'',
                passwordCheck:true
            }
        },

        methods:{

            validateUsername(){

                let form = document.querySelector('form[name="new-user"]');
                setTimeout(()=>{
                    fetch('/api/user/check-username',{
                        method:'POST',
                        body:new FormData(form)
                    }).then(response => response.text() ).then(data => data === 'success' ? this.username = data : this.username = JSON.parse(data))
                    //Second condition of promise converts to JSON the error and saves it to Username.
                    //First condition saves success message to username field.

                },2000)

            },
            validatePassword(){

                let form = document.querySelector('form[name="new-user"]');

                setTimeout( ()=>{

                    fetch('/api/user/check-password',{
                        method:'POST',
                        body:new FormData(form)
                    }).then(response => response.text() ).then(data => data === 'success' ? this.password = data : this.password = JSON.parse(data))

                },2000)


            },
            validateEmail(){

                let form = document.querySelector('form[name="new-user"]');
                setTimeout( ()=>{
                    fetch('/api/user/check-email',{
                        method:'POST',
                        body:new FormData(form)
                    }).then(response => response.text() ).then(data => data === 'success' ? this.email = data : this.email = JSON.parse(data))
                } ,2000)

            },

            confirmPassword(){

                setTimeout( ()=>{
                    return (this.$refs.password.value == this.$refs.passwordConfirm.value) ? this.passwordCheck = true : this.passwordCheck = false
                } ,3000)


            }

        }
    }
</script>
