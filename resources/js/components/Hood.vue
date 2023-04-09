<template>
    <div>
        <div id="logo">
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
                        <!-- Begin::Type Selector -->
                        <div id="type-select-wrapper">
                            <ModelSelect
                                :key="4"
                                v-model="type"
                                placeholder="Choose Type"
                                :options="types"
                                @change="dataSelected"
                            />
                        </div>
                        <!-- End::Type Selector -->

                        <div id="country-state-selectors-wrapper">
                            <!-- Begin::Country Selector -->
                            <div id="country-select-wrapper">
                                <ModelSelect
                                    :key="1"
                                    v-model="country"
                                    placeholder="Choose Country"
                                    :options="countries"
                                    @change="dataSelected"
                                />
                            </div>
                            <!-- End::Country Selector -->

                            <!-- Begin::State Selector -->
                            <div id="state-select-wrapper">
                                <ModelSelect
                                    :key="2"
                                    :isDisabled="!states.length > 0"
                                    v-model="state"
                                    placeholder="Choose State"
                                    :options="states"
                                    @change="dataSelected"
                                />
                            </div>
                            <!-- End::Country Selector -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ModelSelect } from "vue-search-select";
import "vue-search-select/dist/VueSearchSelect.css";
export default {
    components: {
        ModelSelect,
    },
    data() {
        return {
            statesDisable: false,
            initStates: [],
            types: [],
            countries: [],
            countryStates: [],
            states: [],
            type: "",
            country: "",
            state: "",
            search: "",
        };
    },
    watch: {
        type(val, oldVal) {
            if (val == undefined) {
                this.type = "";
            }
            this.dataSelected();
        },
        country(val, oldVal) {
            if (val == undefined) {
                this.country = "";
            }
            this.countrySelected();
            this.dataSelected();
        },
        state(val, oldVal) {
            if (val == undefined) {
                this.state = "";
            }
            this.dataSelected();
        },
    },
    props: {},

    methods: {
        async init() {
            const data = [
                { value: "MSP_Partner", text: "MSP Partner" },
                { value: "Preferred_Partner", text: "Preferred Partner" },
                { value: "Premium_Partner", text: "Premium Partner" },
                { value: "Elite_Partner", text: "Elite Partner" },
                { value: "Distributor", text: "Distributor" },
            ];
            this.types = data;
            this.setCountries();
            this.setStates();
        },
        async setCountries() {
            try {
                const countriesResponse = await fetch("api/countries");

                if (countriesResponse.status === 200) {
                    let countriesResult = await countriesResponse.json();
                    const countries = [];
                    countriesResult.data.forEach((element) => {
                        countries.push({
                            text: element.name,
                            value: element.short_name,
                            states: element.states,
                        });
                    });

                    this.countries = countries;
                }
            } catch (error) {}
        },
        async setStates() {
            try {
                const statesResponse = await fetch("api/states");

                if (statesResponse.status === 200) {
                    let statesResult = await statesResponse.json();
                    const states = [];
                    statesResult.data.forEach((element) => {
                        states.push({
                            text: element.name,
                            value: element.short_name,
                        });
                    });
                    this.initStates = states;
                    this.states = states;
                }
            } catch (error) {}
        },
        countrySelected() {
            this.countries.map((c) => {
                const states = [];
                if (c.value === this.country) {
                    c.states.forEach((element) => {
                        states.push({
                            text: element.name,
                            value: element.short_name,
                        });
                    });
                    this.states = states;
                }
            });

            if (!this.country) {
                this.states = this.initStates;
            }
            this.state = "";
        },
        dataSelected() {
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

<style scoped>
/* Common Styles */
#hood-wrapper {
    background-image: url("../../assets/images/bg_large.png");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    min-height: 500px;
    padding: 0;
    color: #fff;
    text-align: center;
}

#logo {
    height: 90px;
    padding: 32px 0 0 120px;
    background-color: #f2f2f2;
}

#search-selectors-wrapper {
    max-width: 700px;
    margin: 50px auto 0 auto;
    color: #fff;
}
#search-wrapper {
    border: 1px solid #ffffff;
    padding: 0;
    margin: 0 auto 15px auto;
    background-color: #ffffff;
    border-radius: 5px;
    width: 621px;
    display: flex;
}

#search-input {
    box-sizing: border-box;
    height: 45px;
    background: #ffffff;
    border: none;
    margin: 0;
    padding: 0 15px;
    flex-grow: 4;
}

#search-icon {
    margin: 0 10px 0 0;
    height: 45px;
    border: none;
    background: none;
    flex-grow: 0;
}

#selectors-wrapper {
    padding: 0;
    margin: 0 auto 15px auto;
    width: 621px;
    display: flex;
    justify-content: space-around;
    background: none;
}

#type-select-wrapper,
#country-select-wrapper,
#state-select-wrapper {
    background: none;
    border: 2px solid #fff;
    border-radius: 5px;
    color: #fff !important;
}

#type-select-wrapper div,
#country-select-wrapper div,
#state-select-wrapper div {
    width: 100%;
    box-sizing: border-box;
    background: none;
    color: #fff !important;
    display: block;
}

/* Small Screen Styles */
@media only screen and (max-width: 767px) {
    #hood-content-wrapper {
        width: 288px;
        margin: auto;
    }

    #title-description-wrapper {
        padding-top: 50px;
        margin-bottom: 30px;
    }

    #title {
        font-style: normal;
        font-weight: 700;
        font-size: 30px;
        line-height: 40px;
    }

    #description {
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 28px;
    }

    /* Selectors */
    #search-selectors-wrapper {
        display: block;
        margin: 40px auto 0 auto;
    }
    #search-wrapper,
    #selectors-wrapper,
    #type-select-wrapper {
        display: block;
        width: 100%;
    }

    #search-input {
        width: 90%;
    }

    #type-select-wrapper,
    #country-select-wrapper,
    #state-select-wrapper {
        width: 100%;
        height: 38px;
        margin-bottom: 5px;
        color: #fff !important;
    }
}

@media only screen and (min-width: 767px) {
    #title-description-wrapper {
        padding-top: 120px;
    }

    #title {
        font-size: 46px;
        line-height: 28px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    #description {
        font-size: 16px;
        line-height: 32px;
        max-width: 700px;
        margin: auto;
    }

    #type-select-wrapper,
    #country-select-wrapper,
    #state-select-wrapper {
        width: 200px;
        height: 38px;
    }

    #country-state-selectors-wrapper {
        display: flex;
    }

    #country-select-wrapper {
        margin-left: 15px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    #state-select-wrapper {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-left: 1px solid #fff;
    }
}
</style>
