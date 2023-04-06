<template>
    <div>
        <SelectsInputs @data-selected="setData" />
        <div v-show="!partners.length > 0">
            Your search parameters did not match any partners. Please try
            different search.
        </div>
        <Tile v-for="partner in partners" :key="partner.id" />
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
