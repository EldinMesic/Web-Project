const itemsGrid = document.querySelector('.items-grid');
const prevPageButtons = document.querySelectorAll('.prev-button');
const nextPageButtons = document.querySelectorAll('.next-button');
const pageBadges = document.querySelectorAll('.page-badge');
const pppDropDown = document.getElementById("pppDropdown");
const sbDropDown = document.getElementById("sbDropdown");
const topButton = document.getElementById("myBtn");

var amountOfItemsPerPage = 10;
var currentPage = 1;

var items = [];

//page button
function goPrevPage(){
    var lastPage = Math.ceil(items.length/amountOfItemsPerPage);
    if(currentPage == 1){
        return;
    }

    if(currentPage == lastPage){
        nextPageButtons[0].classList.remove('disable-button');
        nextPageButtons[0].disabled = false;

        nextPageButtons[1].classList.remove('disable-button');
        nextPageButtons[1].disabled = false;

    }

    currentPage--;
    fillPokemonsPage();
    

    if(currentPage== 1){
        prevPageButtons[0].classList.add('disable-button');
        prevPageButtons[0].disabled = true;

        prevPageButtons[1].classList.add('disable-button');
        prevPageButtons[1].disabled = true;

    }

}
function goNextPage(){
    var lastPage = Math.ceil(items.length/amountOfItemsPerPage);
    if(currentPage == lastPage){
        return;
    }


    if(currentPage == 1){
        prevPageButtons[0].classList.remove('disable-button');
        prevPageButtons[0].disabled = false;

        prevPageButtons[1].classList.remove('disable-button');
        prevPageButtons[1].disabled = false;

    }

    currentPage++;
    fillPokemonsPage();

    if(currentPage == lastPage){
        nextPageButtons[0].classList.add('disable-button');
        nextPageButtons[0].disabled = true;

        nextPageButtons[1].classList.add('disable-button');
        nextPageButtons[1].disabled = true;

    }

}
function disablePageButtons(){
    prevPageButtons[0].removeEventListener('click', goPrevPage);
    nextPageButtons[0].removeEventListener('click', goNextPage);

    prevPageButtons[1].removeEventListener('click', goPrevPage);
    nextPageButtons[1].removeEventListener('click', goNextPage);
}
function enablePageButtons(){
    prevPageButtons[0].addEventListener('click', goPrevPage);
    nextPageButtons[0].addEventListener('click', goNextPage);

    prevPageButtons[1].addEventListener('click', goPrevPage);
    nextPageButtons[1].addEventListener('click', goNextPage);
}

//dropdown control
pppDropDown.addEventListener('change', () => {
    var lastPage = Math.ceil(items.length/amountOfItemsPerPage);

    if(currentPage== 1){
        prevPageButtons[0].classList.remove('disable-button');
        prevPageButtons[0].disabled = false;

        prevPageButtons[1].classList.remove('disable-button');
        prevPageButtons[1].disabled = false;
    }
    if(currentPage == lastPage){
        nextPageButtons[0].classList.remove('disable-button');
        nextPageButtons[0].disabled = false;

        nextPageButtons[1].classList.remove('disable-button');
        nextPageButtons[1].disabled = false;
    }

    var prevAmount = amountOfItemsPerPage;
    amountOfItemsPerPage = pppDropDown.value;    
    
    
    currentPage = Math.floor(1 + ( (currentPage-1)*prevAmount/amountOfItemsPerPage));
    
    if(currentPage== 1){
        prevPageButtons[0].classList.add('disable-button');
        prevPageButtons[0].disabled = true;

        prevPageButtons[1].classList.add('disable-button');
        prevPageButtons[1].disabled = true;
    }
    if(currentPage == lastPage){
        nextPageButtons[0].classList.add('disable-button');
        nextPageButtons[0].disabled = true;

        nextPageButtons[1].classList.add('disable-button');
        nextPageButtons[1].disabled = true;
    }

     
    fillPokemonsPage();

});
sbDropDown.addEventListener('change', () => {
    items.sort((a,b) => a.id - b.id);


    if(sbDropDown.value === "name")
        items.sort((a,b) => a[sbDropDown.value] > b[sbDropDown.value] ? 1 : -1);
    else if(sbDropDown.value === "count")
        items.sort((a,b) => b[sbDropDown.value] - a[sbDropDown.value]);
    else if(sbDropDown.value === "rarity")
        items.sort((a,b) => rarityToInt(a[sbDropDown.value]) - rarityToInt(b[sbDropDown.value]));
    else
        items.sort((a,b) => a[sbDropDown.value] - b[sbDropDown.value]);
    
    fillPokemonsPage();

});




function loadPokemon(pokemons, userPokemons){

    const pokemonArray = pokemons.map((pokemon => ({
        id: pokemon.id,
        name: pokemon.name,
        image: pokemon.image,
        description: pokemon.description,
        stats: [
            {name: "Attack", value: pokemon.atk},
            {name: "Health", value: pokemon.hp},
            {name: "Defense", value: pokemon.def},
            {name: "Sp Atk", value: pokemon.sp_atk},
            {name: "Sp Def", value: pokemon.sp_def},
            {name: "Speed", value: pokemon.spd}
        ],
        location: parseInt(pokemon.location),
        count: userPokemons.filter(el => el.pokemonID === pokemon.id).length,
        isShiny: userPokemons.filter(el => el.pokemonID === pokemon.id && el.isShiny).length !== 0,
        rarity: pokemon.rarity 
    })));

    items = pokemonArray;
    fillPokemonsPage();
    enablePageButtons();
    
}

function rarityToInt(rarity){
    switch (rarity) {
        case "rare":
            return 2;
        case "epic":
            return 3;
        case "legendary":
            return 4;
        case "mythic":
            return 5;
        default:
            return 1;
    }
}


function fillPokemonsPage() {
    itemsGrid.innerHTML = "";
    pageBadges[0].textContent = currentPage;
    pageBadges[1].textContent = currentPage;

    var pokemonsToShow = currentPage*amountOfItemsPerPage <= items.length ? 
        amountOfItemsPerPage : 
        items.length - (currentPage-1)*amountOfItemsPerPage;

    for(let step = 0; step<pokemonsToShow; step++ ){
        item = items[step+(amountOfItemsPerPage*(currentPage-1))];
        createPokemon(item);
    }


}
function createPokemon(item){
    let itemElement = document.createElement('div');
    itemElement.classList.add('item');

    itemElement.id = item.id.toString();
    if(item.count === 0){       
        var imagePath = findBackgroundImage("?");
        itemElement.innerHTML = `
            <gimg class="background-image-disabled" style="background-image:${imagePath};">
                <img src="${item.image}" alt="${item.name}" loading="lazy" class="pokemon-image disabled">
            </gimg>
            <h2 style="text-align:center">???</h2>
            <p>ID: ${item.id}</p>
            <button class="details-btn disabled">See Details</button>
            <br>
        `;
    }else{
        itemElement.classList.add(item.rarity);

        var imagePath = findBackgroundImage(item.location);
        var itemName = item.isShiny ? `<b style="color:orange;">${item.name}*</b>` : item.name;
        var itemImage = item.isShiny ? `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/${item.id}.png` : item.image;

        itemElement.innerHTML = `
            <gimg class="${item.rarity}" style="background-image:${imagePath};">
                <img src="${itemImage}" alt="${item.name}" loading="lazy" class="pokemon-image">
            </gimg>
            <h2 style="text-align:center">${itemName}</h2>
            <p>ID: ${item.id}</p>
            <form action="pokemonDetails.php" method="post">
            <button class="details-btn" type="submit" name="pokemonID" value="${item.id}">See Details</button>
            </form>
            <br>
        `;
    }

    itemsGrid.appendChild(itemElement);
}



function findBackgroundImage(location){

    switch (location) {
        case 1:
            return "url('http://localhost/Web-Project/images/forest.jpg')";
        case 2:
            return "url('http://localhost/Web-Project/images/coast.jpg')";
        case 3:
            return "url('http://localhost/Web-Project/images/glacier.jpg')";
        case 4:
            return "url('http://localhost/Web-Project/images/cave.jpg')";
        case 5:
            return "url('http://localhost/Web-Project/images/volcano.jpg')";
        case 6:
            return "url('http://localhost/Web-Project/images/void1.png')";
        default:
            return "url('http://localhost/Web-Project/images/unknownPokemon.jpg')";
    }


}




  
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.documentElement.scrollTop = 0;
}


//execution
prevPageButtons[0].disabled = true;
prevPageButtons[1].disabled = true;

