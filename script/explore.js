



function createLocation(index, pokemonsInLocation){
    let locationElement = document.createElement('div');
    locationElement.classList.add('location');

       
    var imagePath = findBackgroundImage(index);
    var locationName = parseLocation(index);
    var staminaCost = locationToStamina(index);
    locationElement.id = locationName;


    locationElement.innerHTML = `
        <gimg class="background-image" style="background-image:${imagePath};">
            <h2>${locationName}</h2>    
        </gimg>

        <h3 style="text-align:center">Exploration Cost:  <g style="font-size:xx-large;">${staminaCost}</g>  Stamina</h3>

        <form class="form" action="location.php" method="post">
            <input type="hidden" name="cost" value="${staminaCost}"></input>
            <button type="submit" name="location" value="${index}">Explore</button>
        </form>   
        `;

    document.querySelector(".explore-container").appendChild(locationElement);
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
function locationToStamina(location){
    switch (location) {
        case 1:
            return 20;
        case 2:
            return 35;
        case 3:
            return 60;
        case 4:
            return 50;
        case 5:
            return 35;
        default:
            return 100;
    }
}



function initializeLocations(pokemonsInLocations){
    for(var i =0; i<5; i++){
        createLocation(i+1, pokemonsInLocations[i].concat(pokemonsInLocations[5]));
    }
}


function convertRange( value, r1, r2 ) { 
    return ( value - r1[ 0 ] ) * ( r2[ 1 ] - r2[ 0 ] ) / ( r1[ 1 ] - r1[ 0 ] ) + r2[ 0 ];
}

function explorePokemons(pokemonsInLocation){
    var commonPokemons = pokemonsInLocation.filter(el => el.rarity=="common");
    var epicPokemons = pokemonsInLocation.filter(el => el.rarity=="epic");
    var rarePokemons = pokemonsInLocation.filter(el => el.rarity=="rare");
    var legendaryPokemons = pokemonsInLocation.filter(el => el.rarity=="legendary");
    var mythicPokemons = pokemonsInLocation.filter(el => el.rarity=="mythic");
    

    var commonValue = commonPokemons.length*8;
    var rareValue = commonValue + rarePokemons.length*4;
    var epicValue = rareValue + epicPokemons.length*3
    var legendaryValue = epicValue + legendaryPokemons.length*3;

    var commonTreshold = convertRange( commonValue, [ 0, legendaryValue ], [ 0, 0.99 ] );
    var rareTreshold = convertRange( rareValue, [ 0, legendaryValue ], [ 0, 0.99 ] );
    var epicTreshold = convertRange( epicValue, [ 0, legendaryValue ], [ 0, 0.99 ] );
    var legendaryTreshold = 0.99



    for(var i = 0; i<3; i++){
        var random = Math.random();
        var pokemon;
        if(random>= legendaryTreshold){
            pokemon = mythicPokemons[Math.floor(Math.random() * mythicPokemons.length)];
        }else if(random>= epicTreshold){
            pokemon = legendaryPokemons[Math.floor(Math.random() * legendaryPokemons.length)];
        }else if(random>= rareTreshold){
            pokemon = epicPokemons[Math.floor(Math.random() * epicPokemons.length)];
        }else if(random>= commonTreshold){
            pokemon = rarePokemons[Math.floor(Math.random() * rarePokemons.length)];
        }else{
            pokemon = commonPokemons[Math.floor(Math.random() * commonPokemons.length)];
        }

        createCaughtPokemon(pokemon);
    }
}

function createCaughtPokemon(pokemon){
    let locationElement = document.createElement('div');
    locationElement.classList.add('pokemon-choice');

    var isShiny = Math.random() >= 0.9 ? 1 : 0;
    var image = isShiny ? `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/shiny/${pokemon.id}.png` : `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemon.id}.png`;
    var name = isShiny ? `<g style="color:orange;"> #${pokemon.id} ${pokemon.name} </g>` : `#${pokemon.id} ${pokemon.name}`;


    locationElement.innerHTML = `
        <form action="catchPokemon.php" method="post">
            <input type="hidden" name="isShiny" value="${isShiny}"></input>
            <button style="background:${rarityToColor(pokemon.rarity)};" type="submit" name="pokemonID" value="${pokemon.id}">
                <img src="${image}"/>
            </button>
        </form>
        <h1>${name}</h1>  
        `;

    document.querySelector(".pokemon-container").appendChild(locationElement);
}

function rarityToColor(rarity){
    switch (rarity) {
        case "common":
            return "lightgrey";
        case "rare":
            return "rgb(43, 99, 255)";
        case "epic":
            return "rgb(101, 26, 133)";
        case "legendary":
            return "rgb(221, 188, 0)";
        case "mythic":
            return "rgb(168, 0, 0)";
        default:
            return "#fff";
    }
}