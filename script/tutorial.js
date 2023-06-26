

function writeText(textSegment){
    isSegmentFinished = false;
    var i = 0;
    var count=0;
    speechBubble.innerHTML = "";
    interval = setInterval(() => {
        if(i<textSegment.length){
            speechBubble.innerHTML += textSegment[i];
            i++;
        }else{
            isSegmentFinished = true;
            if(count>=7){
                speechBubble.innerHTML += ' .';
                count=0;
            }   
            if(speechBubble.innerHTML.length>=textSegment.length+6){
                speechBubble.innerHTML = speechBubble.innerHTML.substring(0, textSegment.length);
            }
            
            count++;

        }
        
        
    }, 50);
}


function writeSpeech(){
    if(isSegmentFinished && textSegmentIndex>= text.length){
        clearInterval(interval);
        showPokemon();
        window.removeEventListener('click', writeSpeech);
    }else if(isSegmentFinished){
        clearInterval(interval);
        writeText(text[textSegmentIndex]);
        textSegmentIndex++;
    }
}

function startSpeech(username){
    speechBubble = document.querySelector("#text-bubble p");

    text.push(
        `Hello, there ${username}! Glad to meet you!`,
        "Welcome to the Pokopy Website! My name is Professor Oak.",
        "This website is inhabited by creatures called Pokémon.",
        "For some people, Pokémon are pets. Other use them for battling.",
        "As for myself, I study Pokémon as a profession.",
        "But first, tell me a little about yourself.",
        "Are you a boy? Or are you a girl?",
        "What? You can't answer because the developer was lazy? Absurd!",
        "Well, anyways.",
        "Please select your starting Pokémon. It will be your partner through the journey."
    );

    writeText(text[textSegmentIndex]);
    textSegmentIndex++;
}


function showPokemon(){
    textSegment = "Hover over a Pokémon and I will tell you something about it.";
    speechBubble.innerHTML = "";
    var i = 0;
    interval = setInterval(() => {
        if(i<textSegment.length){
            speechBubble.innerHTML += textSegment[i];
            i++;
        }
    }, 50);


    modal = document.querySelector(".modal");
    document.querySelector(".close").addEventListener('click', () => modal.classList.toggle('show-modal'));
    document.querySelector("#no-btn").addEventListener('click', () => modal.classList.toggle('show-modal'));

    var pokemons = document.querySelectorAll(".pokemon-container img");
    setTimeout(() => {
        pokemons[0].style.opacity = 1;
        pokemons[0].addEventListener('mouseover', () => pokemonHover(pokemons[0].dataset.name));
        pokemons[0].addEventListener('click', () => selectPokemon("Bulbasaur", 1));
    },1000);
    setTimeout(() => {
        pokemons[1].style.opacity = 1;
        pokemons[1].addEventListener('mouseover', () => pokemonHover(pokemons[1].dataset.name));
        pokemons[1].addEventListener('click', () => selectPokemon("Charmander", 4));
    },2000);
    setTimeout(() => {
        pokemons[2].style.opacity = 1;
        pokemons[2].addEventListener('mouseover', () => pokemonHover(pokemons[2].dataset.name));
        pokemons[2].addEventListener('click', () => selectPokemon("Squirtle", 7));
    },3000);

}

function selectPokemon(pokemon, id){
    modal.classList.toggle('show-modal');
    selectedPokemon = pokemon;
    document.querySelector("#yes-btn").value = id;
    modal.querySelector(".modal-content h2").innerHTML = `Are you sure you want to select ${selectedPokemon} as your partner?`;
}

function pokemonHover(pokemon){
    textSegment = pickSegment(pokemon);
    clearInterval(interval);
    speechBubble.innerHTML = "";
    var i = 0;
    interval = setInterval(() => {
        if(i<textSegment.length){
            speechBubble.innerHTML += textSegment[i];
            i++;
        }
    }, 50);
}

function pickSegment(pokemon){
    switch (pokemon) {
        case "bulbasaur":
            return "Bulbasaur is a dual-type Grass/Poison Pokémon. It is an amphibian Pokémon with red eyes and a green bulb on its back.";
        case "charmander":
            return "Charmander is a Fire-type Pokémon. It is a bipedal, reptillian Pokémon with a primarily orange body and blue eyes.";
        case "squirtle":
            return "Squirtle is a Water-type Pokémon. It is a small reptillian Pokémon that resembles a light-blue turtle.";
        default:
            return "";
    }
}

var selectedPokemon;
var modal;
var textSegmentIndex = 0;
var interval;
var isSegmentFinished = false;
let speechBubble;
const text = [];


window.addEventListener('click', writeSpeech);