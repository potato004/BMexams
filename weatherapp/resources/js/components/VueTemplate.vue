<template>
    <div id="app" class="default">
        <main>
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-box">
                        <div class="icon-container">
                            <i class="fa fa-search"></i>
                        </div>
                        <select v-model="query" class="search-bar">
                            <option value="">Select One...</option>
                            <option v-for="city in cities" v-bind:key="city.id" :value="city.name">
                                {{ city.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12 row" v-if="query != ''">
                    <div class="col-lg-8">
                        <weather :qry="query"></weather>
                    </div>
                    <div class="col-lg-4 row">
                        <suggestion :qry="query"></suggestion>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import Suggestion from './Suggestion.vue';
    import Weather from './Weather.vue';
    export default {
        data() {
            return {
                cities: [],
                country:    'JP',
                query:      '',
            }
        },

        created() {
            this.fetchCities();
        },

        methods: {
            fetchCities() {
                fetch('api/cities')
                    .then(res => res.json())
                    .then(res => {
                        this.cities = res.data;
                    })
            }
        }
    }
</script>

<style scoped>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    #app {
        background-size: cover;
        background-position: bottom;
        transition: 0.4s;
        max-width: 1400px;
        margin: auto;
    }

    .default {
        background: #50C9C3;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #96DEDA, #50C9C3);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #96DEDA, #50C9C3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    main {
        min-height: 100vh;
        padding: 25px;
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.05));
    }

    .search-box {
        width: 100%;
        margin-bottom: 30px;
    }

    .search-box .icon-container {
        display: inline-block;
        color: #dddddd;
    }

    .search-bar {
        display: inline-block;
        width: 93%;
        padding: 15px;
        
        appearance: none;
        border: none;
        background-color: transparent;
        transition: 0.2s;

        color: #dddddd;
        font-size: 17px;
        border-bottom: 1px solid #dddddd;
    }

    .search-bar:hover {
        color: #ffffff;
        font-size: 20px;
        border-bottom: 1px solid #ffffff;
    }

    .search-bar:focus {
        color: #ffffff;
        font-size: 20px;
        border-bottom: 1px solid #ffffff;
    }

    .search-bar option {
        background-color: gray;
    }
</style>