const itemContainer = document.querySelector(".item-container");

function createPokemonDetails(pokemon, userPokemons){
    var pokemonInfo = userPokemons.filter(el => el.pokemonID === pokemon.id);

    var userPokemon = {
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
        count: pokemonInfo.length,
        isShiny: pokemonInfo.filter(el => el.isShiny).length !== 0,
        rarity: pokemon.rarity  
    }


    createItem(userPokemon);
}


function createItem(item){

    itemContainer.classList.add(item.rarity);

    var imagePath = findBackgroundImage(item.location);
    var itemName = item.isShiny ? `<b style="color:orange;">#${item.id}  ${item.name}*</b>` : `#${item.id}  ${item.name}`;
    var itemImage = item.isShiny ? `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/${item.id}.png` : item.image;

    itemContainer.innerHTML = `
        <gimg class="${item.rarity}" style="background-image:${imagePath};">
            <img src="${itemImage}" alt="${item.name}" loading="lazy" class="pokemon-image">
        </gimg>
        <div class="info-panel">
            <h2 style="text-align:center">${itemName}</h2>
            <g id="stats-panel">
                <p>${item.stats[0].name}: ${item.stats[0].value}</p>
                <p>${item.stats[1].name}: ${item.stats[1].value}</p>
                <p>${item.stats[2].name}: ${item.stats[2].value}</p>
                <p>${item.stats[3].name}: ${item.stats[3].value}</p>
                <p>${item.stats[4].name}: ${item.stats[4].value}</p>
                <p>${item.stats[5].name}: ${item.stats[5].value}</p>
            </g>
            <h3>${item.description}</h3>
            <p>Rarity: ${item.rarity.charAt(0).toUpperCase() + item.rarity.slice(1)}</p>
            <p>Location: ${parseLocation(item.location)}</p>
            <p>Amount Caught: ${item.count}</p>
            <p>Caught Shiny: ${item.isShiny ? "Yes" : "No"}</p>
        </div>
        
        <br>
    `;


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


function parseLocation(location){
    switch (location) {
        case 1:
            return "Forest";
        case 2:
            return "Coast";
        case 3:
            return "Glacier";
        case 4:
            return "Cave";
        case 5:
            return "Volcano";
        case 6:
            return "???";
        default:
            return "Unknown";
    }
}






