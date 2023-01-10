<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Donation</div>
                    <div class="card-body">
                        <b-form>
                            <b-form-group id="input-group-1" label="Campaign:" label-for="input-1">
                                <b-form-select id="input-1" v-model="form.campaignId" :options="campaigns" required></b-form-select>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Donor Name:" label-for="input-2">
                                <b-form-input id="input-2" v-model="form.donorName" type="text" required></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-3" label="Amount:" label-for="input-3">
                                <b-form-input id="input-3" v-model="form.amount" required></b-form-input>
                            </b-form-group>
                            <b-button @click.prevent = onSubmit() type="submit" variant="primary">Submit</b-button>
                        </b-form>
                    </div>
                        <table class="m-5 " style="border: 1px solid black" >
                            <th>N</th>
                            <th>Donation name</th>
                            <th>amount</th>
                            <th>Campaign name</th>
                            <tr v-for="(item, index) in donations" :key="item.id">
                                <td>{{ index+1 }}</td>
                                 <td>{{ item.donorName }}</td>
                                <td>{{ item.amount }}</td>
                                <td>{{ item.campaign.title }}</td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Donation",

    data() {
        return {
            form: {
                "campaignId": null,
                "donorName": "",
                "amount": null,
            },
            donations: [],
            campaigns:[]
        }
    },
    mounted() {
        this.getDonations(),
        this.getCampaigns()
    },
    methods: {
        getDonations() {
            this.axios.get('api/donations').then((response) => {
                this.donations=response.data.data
            })
        },
        getCampaigns() {
            this.axios.get('api/campaigns').then((response) => {
                this.campaigns = response.data.data.map((item) => ({
                    text: item.title,
                    value: item.id
                }))

                console.log(response.data)
            })
        },
        onSubmit()
        {
            // console.log(this.form);
            this.axios.post('api/donations', this.form).then((response) => {
                console.log(response);
                this.donations = response.data.data
                this.getDonations()
            })
            console.log('jkblhvlh')
        },
    },
}
</script>
