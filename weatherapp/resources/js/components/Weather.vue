<template>
    <div class="col-md-12 row weather-wrap"  v-if="query != ''">
        <div class="location-box col-lg-12">
            <div class="location">{{weather.name}}, {{weather.sys.country}}</div>
            <div class="date">{{dateBuilder()}}</div>
        </div>

        <div class="weather-box col-lg-12">
            <div class="temp">{{Math.round(weather.main.temp)}}°c</div>
            <div class="icon-container">
                <img :src="setImage(weather.weather[0].icon)" alt="">
            </div>
            <div class="weather">{{weather.weather[0].main}}</div>
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
                    this.fetchWeather();
                }
            }
        },
        data() {
            return {
                weather_api_key:    '473d673de5d75ec05af6331e6b9081a2',
                weather_api_url:    'https://api.openweathermap.org/data/2.5/weather',
                weather_icon_url:   'http://openweathermap.org/img/wn/',
                
                country:    'JP',
                query:      '',
                weather:    {},
            }
        },
        methods: {
            fetchWeather () {
                fetch(`${this.weather_api_url}?q=${this.query}&units=metric&APPID=${this.weather_api_key}`)
                    .then(res => {
                        return res.json();
                    }).then(this.setWeatherResults)
                    .then(this.date_function);
            },
            setWeatherResults(results) {
                this.weather = results;
                console.log(results);
            },
            setImage(img) {
                return this.weather_icon_url + img  + '@2x.png';
            },
            setQuery(val) {
                this.query = val;
            },
            dateBuilder: function () { 
                let currentDate = new Date();
    
                //let formatted_date = new Date().toJSON().slice(0,10).replace(/-/g,' ');
                return currentDate;
            }
        }
    }
</script>

<style scoped>
    .location-box .location {
        color: #ffffff;
        font-size: 32px;
        font-weight: 500;
        text-align: center;
        text-shadow: 1px 3px rgba(0, 0, 0, 0.25);
    }

    .location-box .date {
        color: #ffffff;
        font-size: 20px;
        font-weight: 300;
        font-style: italic;
        text-align: center;
        margin-bottom: 30px;
    }

    .weather-box {
        text-align: center;
    }

    .weather-box .temp {
        color: #ffffff;
        font-size: 102px;
        text-shadow: 1px 3px rgba(0, 0, 0, 0.25);
        margin: 30xp 0px;
    }

    .weather-box .weather {
        color: #ffffff;
        font-size: 48px;
        font-weight: 700;
        font-style: italic;
        text-shadow: 1px 2px rgba(255, 255, 255, 0.25);
        margin-bottom: 30px;
    }

</style>