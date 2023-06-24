


function createPokemon(item){
    let itemElement = document.createElement('div');
        itemElement.classList.add('item');
        itemElement.id = item.id.toString();
        var imagePath = "url(images/forest.jpg)"
        itemElement.innerHTML = `
            <gimg style="background-image:${imagePath};">
                <img src="${item.image}" alt="${item.name}" loading="lazy" class="pokemon-image">
            </gimg>
            <h2 style="text-align:center">${item.name}</h2>
            <p>ID: ${item.id}</p>
            <p>$${item.price}</p>
            <br><br>
            <form action="product.php" method="post">
		        <button class="add-to-cart-btn blue-hover-btn" type="submit" name="id" value="${item.id-1}">Get Details</button>
	        </form>
        `;
        document.querySelector(".items-grid").appendChild(itemElement);
}


function createCartItem(item){
    let itemElement = document.createElement('div');
    itemElement.classList.add('cart-item');
    itemElement.id = item.id.toString();
    itemElement.innerHTML = `
        <img src="${item.image}" alt="${item.name}" loading="lazy" class="pokemon-image">
        <div class="flex-column">
            <h2 style="text-align:center; margin: 0.5em 0;">${item.name}</h2>

            <div class="flex-row">
                <form action="updateCart.php" method="post" class="flex-column">
                    <div class="flex-row" style="justify-content:center;">
                        <p>Quantity: </p>
                        <input id="quantity-input" type="number" name="quantity" min="0" value="${item.quantity}"></input>
                    </div>
                    <button type="submit" name="id" value="${item.id-1}" id="qUpdate">Update Quantity</button>
                </form>
                <div class="flex-column">
                    <p>Price Per Item: $${item.price}</p>
                    <p id="total-price">Total Price: $${(item.price*item.quantity).toFixed(2)}</p>
                </div>

            </div>

            <form action="updateCart.php" method="post">
                <input type="hidden" name="quantity" value="0"></input>
                <button class="cart-remove-btn" type="submit" name="id" value="${item.id-1}">Remove</button>
            </form>
        </div>
    `;
    document.querySelector(".items-grid-2").appendChild(itemElement);

}

function initializeStamina(staminaFloat){
    clearInterval(staminaInterval);

    const staminaContainer = document.querySelector("#stamina-text"); 
    const staminaInfo = document.querySelector(".stamina-info");
    

    const regenTime = 300;
    const maxStamina = 100;

    var stamina = Math.floor(staminaFloat);

    var secondsUntilRegen = Math.floor((stamina+1-staminaFloat)*regenTime);
    var secondsUntilFullRegen = Math.floor((maxStamina-staminaFloat)*regenTime);

    
    if(stamina===maxStamina){
        secondsUntilRegen = 0;
    }

    
    var timeUntilRegen = parseToRegenTime(secondsUntilRegen);
    var timeUntilFullRegen = parseToRegenTime(secondsUntilFullRegen);
    

    staminaContainer.innerHTML = `Stamina: ${stamina} /100`;
    staminaInfo.innerHTML = `Time until next regen: ${timeUntilRegen}<br>Time until full regen: ${timeUntilFullRegen}`;

    staminaInterval = setInterval(() => {
        if(stamina<100){
            secondsUntilFullRegen--;
            secondsUntilRegen--;

            if(secondsUntilRegen <= 0){
                stamina++;
                secondsUntilRegen = stamina===maxStamina ? 0 : regenTime;
            }


            timeUntilFullRegen = parseToRegenTime(secondsUntilFullRegen);
            timeUntilRegen = parseToRegenTime(secondsUntilRegen);

            staminaContainer.innerHTML = `Stamina: ${stamina} /100`;
            staminaInfo.innerHTML = `Time until next regen: ${timeUntilRegen}<br>Time until full regen: ${timeUntilFullRegen}`;
        }
        
    }, 1000);


}


function parseToRegenTime(seconds){
    var minutes = Math.floor(seconds/60);
    var hours = Math.floor(minutes/60);

    seconds %= 60;
    minutes %= 60;

    seconds = seconds.toString().length === 1 ? `0${seconds}` : seconds;
    minutes = minutes.toString().length === 1 ? `0${minutes}` : minutes;
    hours = hours.toString().length === 1 ? `0${hours}` : hours;

    return `${hours}:${minutes}:${seconds}`;
}

function toggleStaminaInfo(){
    document.querySelector(".stamina-info").classList.toggle("toggle");
}
function removeStaminaInfo(){
    document.querySelector(".stamina-info").classList.remove("toggle");
}
function addStaminaInfo(){
    document.querySelector(".stamina-info").classList.add("toggle");
}


window.onscroll = function() {
    if(window.scrollY >= 130){
        document.querySelector(".navbar").style.top = 0+"px";
    }else{
        document.querySelector(".navbar").style.top = 130-window.scrollY+"px";
    }

};


var staminaInterval;