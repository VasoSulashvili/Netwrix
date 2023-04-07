<template>
    <div>
        <div id="selects-logo">
            <img src="../../assets/images/Netwrix_logo_120x25.png" alt="" />
        </div>
        <div id="hood-wrapper">
            <div id="hood-content-wrapper">
                <div id="title-description-wrapper">
                    <h1 id="title">Netwrix Partner Locator</h1>
                    <p id="description">
                        Hundreds of Netwrix partners around the world are
                        standing by to help you. With our Partner Locator you
                        can easily find the list of authorized partners in your
                        area.
                    </p>
                </div>

                <div id="search-selectors-wrapper">
                    <div id="search-wrapper">
                        <input
                            id="search-input"
                            type="text"
                            placeholder="Search by company name or adress.."
                            v-model="search"
                            @keyup.enter="dataSelected"
                        />
                        <button id="search-icon" @click="dataSelected">
                            <img
                                src="../../assets/images/search-ico.png"
                                alt=""
                            />
                        </button>
                    </div>

                    <div id="selectors-wrapper">
                        <select
                            class="selector-input"
                            @change="dataSelected"
                            v-model="type"
                        >
                            <option selected value="">
                                Choose Partner Type
                            </option>
                            <option v-for="t in types" :value="t" :key="t">
                                {{ t }}
                            </option>
                        </select>
                        <div>
                            <select
                                class="selector-input country-selector-input"
                                @change="dataSelected"
                                v-model="country"
                            >
                                <option selected value="">
                                    Choose Country
                                </option>
                                <option
                                    v-for="c in countries"
                                    :value="c.short_name"
                                    :key="c.id"
                                >
                                    {{ c.name }}
                                </option>
                            </select>

                            <select
                                class="selector-input state-selector-input"
                                :disabled="!states.length > 0"
                                @change="dataSelected"
                                v-model="state"
                            >
                                <option selected value="">Choose State</option>
                                <option
                                    v-for="s in states"
                                    :value="s.short_name"
                                    :key="s.id"
                                >
                                    {{ s.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
