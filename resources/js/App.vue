<template>
    <div>
        <Hood @data-selected="setData" />

        <Spinner :isLoading="isLoading" />

        <div id="empty-result" v-show="resultMessage">
            {{ resultMessage }}
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
import Hood from "./components/Hood.vue";
import Spinner from "./components/Spinner.vue";

export default {
    components: {
        Tile,
        Spinner,
        Hood,
    },
    data() {
        return {
            resultMessage: "",
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
                    this.resultMessage = "";
                    if (!this.partners.length > 0) {
                        this.resultMessage =
                            "Your search parameters did not match any partners. Please try different search.";
                    }
                }
                if (response.status === 429) {
                    this.isLoading = false;
                    this.resultMessage = "Too many attempts";
                }
                if (response.status === 403) {
                    const result = await response.json();
                    this.isLoading = false;
                    Choose;
                    this.partners = result.data;
                    this.partners = [];
                    this.resultMessage = result.data;
                }
            } catch (error) {
                Choose;
                this.resultMessage = error.message;
                this.isLoading = false;
            }
        },
    },
    created() {
        this.init();
    },
};
</script>
