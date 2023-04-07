<template>
    <div class="tile">
        <div class="tile-header">
            <img :src="partner.logo" :alt="partner.company" />
        </div>

        <div class="tile-body">
            <p class="tile-company-name">{{ partner.company }}</p>
            <p class="tile-company-address">{{ partner.address }}</p>
        </div>
        <div class="tile-footer">
            <div class="tile-footer-website-phone">
                <a class="tile-company-website" :href="partner.website"
                    >Website</a
                >
                <p class="tile-company-phone">{{ partner.phone }}</p>
            </div>

            <p class="tile-company-status">{{ partner.status }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: { partner: Object },
};
</script>

<style></style>
