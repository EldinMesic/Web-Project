window.onscroll = function() {
    console.log(window.scrollY);
    if(window.scrollY >= 130){
        document.querySelector(".navbar").style.top = 0+"px";
    }else{
        document.querySelector(".navbar").style.top = 130-window.scrollY+"px";
    }

};





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