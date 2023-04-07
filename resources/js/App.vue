<template>
    <div>
        <SelectsInputs @data-selected="setData" />
        <div id="spinner" v-show="isLoading">
            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"
                >
                    <animateTransform
                        attributeName="transform"
                        type="rotate"
                        dur="0.75s"
                        values="0 12 12;360 12 12"
                        repeatCount="indefinite"
                    />
                </path>
            </svg>
        </div>
        <div v-show="!partners.length > 0">
            Your search parameters did not match any partners. Please try
            different search.
        </div>
        <Tile
            v-for="partner in partners"
            :key="partner.id"
            :partner="partner"
        />
    </div>
</template>

<script>
import Tile from "./components/Tile.vue";
import SelectsInputs from "./components/SelectsInputs.vue";
export default {
    components: {
        Tile,
        SelectsInputs,
    },
    data() {
        return {
            isLoading: false,
            partners: [],
            type: "",
            country: "",
            state: "",
            search: "",
        };
    },
    methods: {
        async init() {
            this.fetchPartners();
        },
        setData(data) {
            this.type = data.type;
            this.country = data.country;
            this.state = data.state;
            this.search = data.search;
            this.fetchPartners();
        },
        async fetchPartners() {
            this.isLoading = true;
            let formData = new FormData();

            formData.set("type", this.type);
            formData.set("country", this.country);
            formData.set("state", this.state);
            formData.set("search", this.search);
            try {
                const response = await fetch("api/partners", {
                    method: "POST",
                    body: formData,
                });

                if (response.status === 200) {
                    const result = await response.json();
                    this.isLoading = false;
                    this.partners = result.data;
                }
            } catch (error) {
                console.log(error);
            }
        },
    },
    created() {
        this.init();
    },
};
</script>
