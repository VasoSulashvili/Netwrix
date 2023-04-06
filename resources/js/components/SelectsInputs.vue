<template>
    <div>
        <input type="text" v-model="search" />{{ search }}
        <button @click="dataSelected">Search</button>
    </div>
    <select @change="dataSelected" v-model="type">
        <option selected value="">Choose Partner Type</option>
        <option v-for="t in types" :value="t" :key="t">
            {{ t }}
        </option>
    </select>

    <select @change="dataSelected" v-model="country">
        <option selected value="">Choose Country</option>
        <option v-for="c in countries" :value="c.short_name" :key="c.id">
            {{ c.name }}
        </option>
    </select>

    <select
        :disabled="!states.length > 0"
        @change="dataSelected"
        v-model="state"
    >
        <option selected value="">Choose State</option>
        <option v-for="s in states" :value="s.short_name" :key="s.id">
            {{ s.name }}
        </option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            types: [],
            countries: [],
            states: [],
            type: "",
            country: "",
            state: "",
            search: "",
        };
    },
    props: {},

    methods: {
        async init() {
            this.types = [
                "MSP Partner",
                "Preferred Partner",
                "Premium Partner",
                "Elite Partner",
                "Distributor",
            ];
            try {
                const countriesResponse = await fetch("api/countries");

                if (countriesResponse.status === 200) {
                    const countriesResult = await countriesResponse.json();
                    this.countries = countriesResult.data;
                }

                const statesResponse = await fetch("api/states");

                if (statesResponse.status === 200) {
                    const statesResult = await statesResponse.json();
                    this.states = statesResult.data;
                }
            } catch (error) {
                console.log(error);
            }
        },
        dataSelected() {
            this.countries.map((c) => {
                if (c.short_name === this.country) this.states = c.states;
            });
            this.$emit("data-selected", {
                type: this.type,
                country: this.country,
                state: this.state,
                search: this.search,
            });
        },
    },
    emits: ["data-selected"],

    created() {
        this.init();
    },
};
</script>

<style></style>
