<template>
    <div class="flex justify-center items-center h-screen">
        <div class="bg-slate-200 p-5 rounded-md shadow-md">
            <h3 class="text-xl font-bold text-start">Form Insert Products</h3>
            <form class="mt-5" @submit.prevent="submitForm">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <div class="flex flex-col">
                        <div class="join">
                            <span class="join-item bg-blue-400 p-3">Product Name</span>
                            <input type="text" class="join-item p-3 bg-white" placeholder="Input Product Name ..." v-model="forms.product_name">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="join">
                            <span class="join-item bg-blue-400 p-3">Product Price</span>
                            <input type="number" class="join-item p-3 bg-white" placeholder="Input Product Price ..." min="1" v-model="forms.product_price">
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-5">
                    <button class="btn btn-primary w-1/4 text-white" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import 'primeicons/primeicons.css'


export default {
    data(){
        return{
            forms:{
                product_name: '',
                product_price: ''
            }
        }
    },
    methods:{
        submitForm(){
            console.log(this.forms)
            axios.post('/my-project/insert-products',{
                forms: this.forms,
                headers:{
                    'Content-Type': 'application/json'
                }
            }).then((response)=>{
                console.log(response);
                console.log("Insert Success");
            }).catch((error)=>{
                console.log(error)
            })

        }
    }
}

</script>
