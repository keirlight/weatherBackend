# Weather application in Vue.JS

## Project setup
1. Install node dependencies
```
npm install
```
2. Create .env file in root folder and add this
```
VUE_APP_WEATHER_API_URL = 'https://api.openweathermap.org/data/2.5'
VUE_APP_WEATHER_API_KEY={OpenWeather api token}
VUE_APP_FOURSQUARE_API_URL = 'https://api.foursquare.com/v3/places'
VUE_APP_FOURSQAURE_API_KEY={OpenWeather api token}

For laravel lumen local
VUE_APP_WEATHER_API_URL = {localhost}
VUE_APP_FOURSQUARE_API_URL = {localhost}
```
3. Compile for development mode
```
npm run serve
```
4. Compile for production mode
```
npm run build
```


## Backend setup
1. setup local server
```
php -S localhost:8000 -t public
```
## Dev notes
- Backend: I used laravel lumen: microservice of laravel
    - My main framework is CodeIgniter, I only have few experience with laravel, so you might see some unused feature of laravel.
- Frontend: I used VueJS
    - This is the first time that I used Vuejs. I just took the challenge to implement it here though I can make it thru Jquery and CodeIgniter PHP framework. Some codes might be in vanila javascript since I don't know yet how to implement it in Vuejs.
- I'm more of a Backend Developer, so UI might be a bit dull. I used MDB as a FE template.

--------------------------------------
1. There are two ways to make vue code work
- First: Use Fousquare and weather api directly
- Second: Use laravel lumen endpoint
    - I made the laravel endpoint to accept same parameters with the Third Party API's.
    - I also made the API response the same with Third Party APi's just to make  VueJs app flexible.
    - I didn't added a handler for token since it will used for minor functionalities only
2. VueJS docs.
- Setup:
    1. Search Page:
        - I created a callAPI function to centralize all api calls
        - I added a live search for near places base on the search value. Upon researching, I found debounce package, I used it to lessen down the API calls to avoid being flaged by the Third party API provider. Instead of calling API every keystroke, API call will be triggered 250ms after the last keypress.
        - If one of the nearby places is clicked, it will automatically show the weather details of the location by using latitude and longitude.
    2. Main Page:
        - I created a callAPI function to centralize all api calls
        - Combinations of four components
            1. Additional Data
                - contains Week Chart, daily weather forecast for five days
                - search field: if triggered it will trigger emit function to MainPage.vue to search the input value
            2. Basic Data
            3. Hourly Weather
            4. Near Places
                - Nearby Places will show if toggle button is clicked
                - If one of the places is ticked, it will show the current weather of the selected place location and it will also show the nearby places.
        - On mount
            - It will populate all the above components

3. I also did some basic setup on Laravel lumen.
- Setup:
    1. Add handler for CORS policy issue by:
        - Creating App/Providers/CatchAllOptionsRequestsProvider.php
        - Creating App/HTTP/Middlewares/CorsMiddleware.php
        - Setup it on bootstrap/app.php
    2. Add WeatherController.php
        - Created Library: WeatherLib.php to standardize the functions to be called. If needed to change the thirdparty in the future, we can just add new library for weather and point it on WeatherController.php
        - WeatherLib is on final class which cannot be extended
    3. Add PlaceController.php
        - Created Library: PlaceSearchLib.php to standardize the functions to be called. If needed to change the thirdparty in the future, we can just add new library for place searching and point it on PlaceController.php
        - PlaceSearchLib is on final class which cannot be extended
    4. Add Utils.php
        - This one is the base library where I created the function to trigger API Calls
        - We can put a generic function here that can be re-used.
    5. API response
        - I didn't really manipulate the API responses. I only replicate the original API response to make Vuejs app flexible.