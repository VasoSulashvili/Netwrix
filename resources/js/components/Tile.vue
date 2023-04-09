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

<style scoped>
@media only screen and (max-width: 767px) {
    /* Tile Styles */
    .tile {
        margin: 20px auto;
        padding: 43px 24px 33px 24px;
        min-height: 418px;
        max-width: 288px;
        background: #ffffff;
        box-shadow: 0px 1px 2px rgba(5, 27, 43, 0.14);
        border-radius: 5px;
    }
    .tile-header {
        margin-bottom: 40px;
    }

    .tile-body {
        border-bottom: 1px solid #dcdee0;
        margin-bottom: 24px;
        padding-bottom: 32px;
    }

    .tile-company-name {
        font-family: "OpenSans";
        font-style: normal;
        font-weight: 700;
        font-size: 21px;
        line-height: 32px;
        color: #354556;
        margin-bottom: 20px;
    }
    .tile-company-address {
        font-family: "OpenSans";
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 24px;
        color: #354556;
        /* margin-bottom: 5px; */
    }

    .tile-company-website {
        font-family: "OpenSans";
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 32px;
        color: #0c70b8;
        /* text-decoration: none; */
        display: block;
    }

    .tile-company-phone {
        font-family: "OpenSans";
        font-style: normal;
        font-weight: 400;
        font-size: 13px;
        line-height: 32px;
        color: #354556;
    }

    .tile-company-status {
        font-family: "OpenSans";
        font-style: normal;
        font-weight: 600;
        font-size: 13px;
        line-height: 32px;
        color: #354556;
    }
}

@media only screen and (min-width: 767px) {
    /* Tile Styles */

    .tile {
        display: flex;

        margin: 20px auto;
        padding: 33px 33px 33px 55px;
        max-width: 1110px;
        min-height: 150px;
        border-radius: 5px;
        background: #ffffff;
        box-shadow: 0px 1px 2px rgba(5, 27, 43, 0.14);
    }

    .tile-header {
        margin-right: 76px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* flex-grow: 2; */
    }

    .tile-body {
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-right: 30px;
    }

    .tile-footer {
        display: flex;
        justify-content: space-between;
        /* background-color: red; */
        width: 50%;
    }

    .tile-company-name {
        font-style: normal;
        font-weight: 700;
        font-size: 21px;
        line-height: 32px;
        color: #354556;
        margin-bottom: 15px;
    }
    .tile-company-address {
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 24px;
        color: #354556;
    }
    .tile-footer-website-phone {
        border-right: 1px solid #dcdee0;
        width: 50%;
    }

    .tile-company-website {
        font-size: 14px;
        line-height: 32px;
        color: #0068da;
    }

    .tile-company-phone {
        font-size: 13px;
        line-height: 32px;
        color: #354556;
    }

    .tile-company-status {
        text-align: center;
        width: 50%;
    }
}
</style>
