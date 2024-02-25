<template>
    <div v-if="successMessage" class="offset-md-2 col-md-8  alert alert-success  offset-md-2">
        {{ successMessage }}
    </div>
    <div v-if="showTripForm">
        <button class="btn btn-success my-2" @click="showAllData">Back</button>
        <h3>Please Enter your Details</h3>


        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="trip_name">Enter Trip Name</label>
                    <input type="text" class="form-control" id="trip_name" name="trip_name" v-model="items.name" />
                    <span v-if="errors.name" class="text-danger">{{
                        errors.name[0]
                    }}</span>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="trip_destination">Enter Trip Destination</label>
                    <input type="text" class="form-control" id="trip_destination" name="trip_destination"
                        v-model="items.destination" />
                    <span v-if="errors.destination" class="text-danger">{{
                        errors.destination[0]
                    }}</span>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="trip_description">Enter Trip Description</label>
                    <textarea name="trip_description" id="trip_description" cols="10" rows="2" class="form-control"
                        v-model="items.description"></textarea>
                    <span v-if="errors.description" class="text-danger">{{
                        errors.description[0]
                    }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Enter Trip Price $ </label>
                    <input type="text" class="form-control" id="price" name="price" v-model="items.price" />
                    <span v-if="errors.price" class="text-danger">{{
                        errors.price[0]
                    }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" v-model="items.start_date" />
                    <span v-if="errors.start_date" class="text-danger">{{
                        errors.start_date[0]
                    }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" v-model="items.end_date" />
                    <span v-if="errors.end_date" class="text-danger">{{
                        errors.end_date[0]
                    }}</span>
                </div>
            </div>
        </div>
        <button class="btn btn-primary my-2" @click="saveTrips">
            {{ isEditing ? "Update" : "Save" }}
        </button>
    </div>
    <div v-if="showAllTrips">
        <button class="btn btn-success my-2" @click="showCreateForm">Create</button>
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Trip</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in list" :key="index">
                        <td scope="row">{{ item.name }}</td>
                        <td>{{ item.destination }}</td>
                        <td>{{ formatDateString(item.start_date) }}</td>
                        <td>{{ formatDateString(item.end_date) }}</td>
                        <td>
                            <i class="fas fa-trash-alt btn btn-danger text-white btn-sm" @click="deleteTrip(item.id)"></i>
                            <i class="far fa-edit btn btn-primary text-white btn-sm mx-2" @click="editData(item)"></i>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Trips",
    data() {
        return {
            items: {
                name: "",
                destination: "",
                description: "",
                start_date: "",
                end_date: "",
                price: "",
            },
            successMessage: "",
            errors: {},
            showTripForm: false,
            showAllTrips: true,
            list: [],
            temp_id:null,
            isEditing:false
        }
    },
    mounted() {
        this.getAllTrips();
    },
    methods:
    {
        formatDateString(dateString) {
            if (dateString) {
                const date = new Date(dateString);
                const options = { year: "numeric", month: "long", day: "numeric" };
                return date.toLocaleDateString("en-US", options);
            }
            return "";
        },
        // Method for saving trip
        saveTrips() {
            let method = axios.post;
            let url = "/api/trips";

            if (this.isEditing) {
                method = axios.put;
                url = `/api/trips/${this.temp_id}`;
            }
           method(url, this.items).then((res) => {
                this.errors = {}
                this.successMessage = res.data.message;
                this.items = {
                    name: "",
                    description: "",
                    destination: "",
                    start_date: "",
                    end_date: ""
                }
                setTimeout(() => {
                    this.successMessage = "";
                }, 5000);
                this.showAllTrips=true,
                 this.showTripForm=false
                 this.getAllTrips();
            }).catch((error) => {
                if (error.response && error.response.data) {
                    const { data } = error.response;
                    if (data.errors) {
                        this.errors = data.errors;
                    }
                }
            });



        },
        // Get All trips from backend
        getAllTrips() {
            axios.get('/admin/trip').then((res) => {
                this.list = res.data
            })
        },
        // delete a trip
        async deleteTrip(id){
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
                    await axios.delete(`/admin/trip/${id}`);
                    Swal.fire("Deleted!", "Your trip has been deleted.", "success");
                }
                this.getAllTrips();
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
        // show create form
        showCreateForm()
        {
            this.showAllTrips=false,
            this.showTripForm=true
        },
        // show All trips
        showAllData()
        {
            this.showAllTrips=true,
            this.showTripForm=false
        },
        // edit data ...
        editData(data)
        {
            this.items ={
                name:data.name,
                destination:data.destination,
                description:data.description,
                price:data.price,
                start_date:data.start_date,
                end_date:data.end_date,

            }
            this.temp_id = data.id
            this.showAllTrips=false
            this.isEditing=true
            this.showTripForm=true
        }

    }
}
</script>
