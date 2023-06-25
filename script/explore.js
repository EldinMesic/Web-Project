const exploreContainer = document.querySelector(".explore-container");






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

        <form action="location.php" method="post">
            <input type="hidden" name="cost" value="${staminaCost}"></input>
            <button type="submit" name="location" value="${index}">Explore</button>
        </form>   
        `;

    exploreContainer.appendChild(locationElement);
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