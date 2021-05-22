import "./bootstrap";

import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {

        foods: [],
        genres: [],
        restaurants: [],
        restaurantIndex: '',

        // imput search
        research: '',
        visible: false,
        genresFiter: [],
        filter: true,

        showGenres: [],
        allRestaurants: [],

        // shop cart
        shopCart: [],
        finalPrice: 0,
        activeGenre: 'Pizzeria',
        counter: '',

        // menù
        showMenu: false,
        showCart: false,
        showGenre: false,
    },
    created() {
        this.getRestaurants();
        this.getFoods();
        this.getGenres();
    },
    mounted() {
        if (localStorage.finalPrice) {
          this.finalPrice = localStorage.finalPrice;
        }
      },
      watch: {
        finalPrice(finalPrice) {
            localStorage.finalPrice = finalPrice;
        }
      },
    methods: {
        puliziaCache(){
            localStorage.clear();
        },
        // Aggiungi al carrello
        addCart(food) {
            let newFood = [];
            newFood.push(food);
            newFood.forEach(element => {
                this.shopCart.push({
                    price: element.price,
                    name: element.name,
                });
            });
            console.log(newFood);
            this.totalPrice(food);
            this.counter = this.shopCart.length;
        },

        //Totale carrello
        totalPrice(food) {
                this.finalPrice += food.price;
        },

        //Barra di ricerca
        searchRestaurant() {
            this.allRestaurants.forEach( el => {
                if (el.name.toLowerCase().includes(this.research.toLowerCase()) && el.visible == 1) {
                    el.visible = 1;
                } else {
                    el.visible = 0;
                }
            });
            if( this.research == '' ) {
                this.allRestaurants.forEach( el => {
                    el.visible = 1;
                });
            }
        },
        genreSelected(index) {
            this.genresFiter.splice(index, 1);
            let url = "http://127.0.0.1:8000/api/deliveroo";
            axios.get(url, {
                params: {
                    genre: this.genresFiter,
                }
            })
            .then( response => {
                    // handle success;
                    this.allRestaurants = response.data;
                })
                .catch( error => {
                    // handle error
                    console.log(error);
                });
        },
        //Filtro dei generi
        filterGenres(genre) {
            if (! this.genresFiter.includes(genre)) {
                this.genresFiter.push(genre);
            }
            let url = "http://127.0.0.1:8000/api/deliveroo";
            axios.get(url, {
                params: {
                    genre: this.genresFiter,
                }
            })
            .then( response => {
                    // handle success;
                    this.allRestaurants = response.data;
                })
                .catch( error => {
                    // handle error
                    console.log(error);
                });
        },
        // resettare la ricerca
        filterNone() {
            this.genresFiter = [];
            let url = "http://127.0.0.1:8000/api/deliveroo";
            axios.get(url)
                .then( response => {
                    // handle success;
                    this.allRestaurants = response.data;
                })
                .catch( error => {
                    // handle error
                    console.log(error);
                });
        },
        //Chiamata API restaurants
        getRestaurants() {
            let url = "http://127.0.0.1:8000/api/deliveroo";
            axios.get(url)
                .then( response => {
                    // handle success;
                    this.allRestaurants = response.data;
                })
                .catch( error => {
                    // handle error
                    console.log(error);
                });
        },
        //Chiamata API foods
        getFoods() {
            axios.get('http://127.0.0.1:8000/api/deliveroo/food').then((result) => {
                this.foods = result.data;
            }).catch((error) => {
                // handle error
                console.log(error);
            });
        },
        // //Chiamata API genres
        getGenres() {
            axios.get('http://127.0.0.1:8000/api/deliveroo/genre').then((result) => {
                this.genres = result.data;

                result.data.forEach(element => {
                    if (!this.showGenres.includes(element.type)) {
                        this.showGenres.push(element);
                    }
                });
            }).catch((error) => {
                // handle error
                console.log(error);
            });
        },
        showRestaurant(restaurant) {
            this.restaurantIndex = restaurant.slug
        },
    }
});
