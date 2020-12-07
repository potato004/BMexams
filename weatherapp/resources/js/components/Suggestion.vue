<template>
    <div class="col-md-12 row suggestion-wrap"  v-if="query != ''">
        <div class="title text-center col-lg-12">
            Places to visit
            <hr>
        </div>
        <div v-for="venue in forsquare.venues" v-bind:key="venue.id" class="card col-lg-12 rounded border mb-2 text-center place">
            <div class="name">{{venue.name}}</div>
            <div class="location">{{venue.location.formattedAddress.join(', ')}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'app',
        props: ['qry'],
        watch: { 
           qry: {
                immediate: true,
                handler(newVal, oldVal) {
                    this.setQuery(newVal);
                    this.fetchSuggestion();
                }
            }
        },
        data() {
            return {
                forsquare_api_url:          'https://api.foursquare.com/v2/venues/search',
                forsquare_api_secret:       'ZPH4ZZ4KPGUZM3ECPWLLIPJVEI4IX20NJ5BGMNQNO5RMT4F4',
                forsquare_api_client_id:    '2BBSVRXHK13JLGMW4ZGT5M3SD5OU1J34WBO4FC3TBTNUSQYI',
                country:                    'JP',
                date:                       new Date().toJSON().slice(0,10).replace(/-/g,''),
                query:                      '',
                forsquare:  {}
            }
        },
        methods: {
            fetchSuggestion() {
                fetch(`${this.forsquare_api_url}?near=${this.query},${this.country}&limit=5&categoryId=4deefb944765f83613cdba6e&client_id=${this.forsquare_api_client_id}&client_secret=${this.forsquare_api_secret}&v=${this.date}`)
                    .then(res => {
                        return res.json();
                    }).then(this.setForsquareResults);
            },
            setQuery(val) {
                this.query = val;
            },
            setForsquareResults(results) {
                this.forsquare = results.response;
            }
        }
    }
</script>

<style scoped>
    .suggestion-wrap {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.10);
        border-radius: 25px;
    }
    .suggestion-wrap .title {
        color: #ffffff;
        font-size: 32px;
        font-weight: 500;
        text-align: center;
        text-shadow: 1px 3px rgba(0, 0, 0, 0.25);
    }

    .suggestion-wrap .place {
        transition: 0.2s;
        padding: 30px;
        background-color: transparent;
    }

    .suggestion-wrap .name {
        font-size: 20px;
        font-weight: 500;
        color: #ffffff;
    }

    .suggestion-wrap .location {
        font-size: 12px;
        font-style: italic;
        color: #dddddd;
    }
</style>