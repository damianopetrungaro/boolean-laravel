# Laravel like a pro

### Vediamo i controller

___

feat-4.patch
Problemi:
    /RestaurantController:  
        - show() può sfruttare il model binding di Laravel con una custom key (slug usato come chiave)
        - show() restaurant ha un problemino di performance
            - prima: https://blackfire.io/profiles/c30ee29b-d76d-4e94-913a-021874f406ea/graph
            - dopo: https://blackfire.io/profiles/b9e48138-791d-4bf4-b40b-e4eb9f6e472d/graph
        - si occupa dei pagamenti... perchè? Creiamo un PaymentController
    /Admin/DeliveryController:
        - logica un filo complessa, ripuliamo variabili e rendiamola semplice
    /Admin/FoodController:
        - ci sono logiche piu volte ripetute, creiamo dei services e delle custom Request
        - logica un filo complessa, ripuliamo variabili e rendiamola semplice
    /Admin/RestaurantController:
        - ci sono logiche piu volte ripetute, creiamo dei services e delle custom Request
        - logica un filo complessa, ripuliamo variabili e rendiamola semplice
