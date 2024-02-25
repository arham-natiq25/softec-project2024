<template>
    <div v-if="successMessage" class="offset-md-2 col-md-8  alert alert-success  offset-md-2">
        {{ successMessage }}
    </div>
    <div>
    <h3>Please Enter your Details</h3>
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="trip">Select Trip</label>
                <select id="trip" class="form-control" v-model="items.trip_id">
                    <option disabled>Select</option>
                    <option v-for="trip in trips" :key="trip.id" :value="trip.id">{{ trip.name }}</option>
                </select>
            </div>
            <span v-if="errors.trip_id" class="text-danger">{{
                errors.trip_id[0]
            }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="question">Enter Question</label>
                <input type="text" class="form-control" id="question" name="question" v-model="items.question" />
                <span v-if="errors.question" class="text-danger">{{
                    errors.question[0]
                }}</span>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="answer">Enter Answer</label>
                <textarea name="trip_description" id="trip_description" cols="10" rows="2" class="form-control"
                    v-model="items.answer"></textarea>
                <span v-if="errors.answer" class="text-danger">{{
                    errors.answer[0]
                }}</span>

            </div>
        </div>
    </div>
    <button class="btn btn-primary my-2" @click="saveQuery">
        {{ isEditing ? "Update" : "Save" }}
    </button>
</div>
<div >
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in list" :key="index">
                    <td scope="row">{{ item.Question }}</td>
                    <td>{{ item.Answer }}</td>
                    <td>
                        <i class="fas fa-trash-alt btn btn-danger text-white btn-sm" @click="deleteQuery(item.id)"></i>
                     </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>
</template>
<script>
import axios from 'axios'


export default {
    data() {
        return {
            showAllQuriers: true,
            showQueryForm: false,
            list: [],
            temp_id: null,
            isEditing: false,
            successMessage: "",
            errors: {},
            items: {
                trip_id: null,
                question: "",
                answer: ""
            },
            trips: [],


        }
    },
    mounted() {
        this.getAllTrips()
        this.getAllQuries()
    },
    methods: {
        showCreateForm() {
            showAllQuriers = false,
            showQueryForm = true
        },
        showALLData() {
            showAllQuriers = true,
            showQueryForm = false
        },
        getAllTrips() {
            axios.get('/admin/trip').then((res) => {
                this.trips = res.data
            })
        },
        saveQuery() {
            let method = axios.post;
            let url = "/admin/queries";

            if (this.isEditing) {
                method = axios.put;
                url = `/api/queries/${this.temp_id}`;
            }

            method(url, this.items).then((res) => {
                this.errors = {}
                this.successMessage = res.data.message;
                this.items = {
                    trip_id: null,
                    answer: null,
                    question: null
                }
                setTimeout(() => {
                    this.successMessage = "";
                }, 5000);
                this.showAllTrips = true,
                    this.showTripForm = false
                this.getAllQuries();
            }).catch((error) => {
                if (error.response && error.response.data) {
                    const { data } = error.response;
                    if (data.errors) {
                        this.errors = data.errors;
                    }
                }
            });
        },
        getAllQuries() {
            axios.get('/admin/queries').then((res)=>{
                this.list = res.data
            })
        },
        async deleteQuery(id){
            try {
                // on click a popup shows of sweet alert
                const confirmed = await Swal.fire({
                    title: "Are you sure?",
                    text: "You will not be able to recover this trip!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                });


                // if click on yes ... request using axios and deleted and show message ..
                if (confirmed.isConfirmed) {
                    await axios.delete(`/admin/queries/${id}`);
                    Swal.fire("Deleted!", "Your trip has been deleted.", "success");
                }
                this.getAllQuries();
                // if getting any error in deleting
            } catch (error) {
                console.error(error);
                Swal.fire(
                    "Error",
                    "An error occurred while deleting the trip.",
                    "error"
                );
            }

        },
    },

}
</script>
