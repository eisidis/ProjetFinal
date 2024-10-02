// Récuparation des class et id en JS
const carouselHtml = document.getElementsByClassName('carousel');
const cat = document.getElementsByClassName('cat')
const domain = document.getElementById('domain')
const itemImg = document.getElementsByClassName('itemImg')

let currentCarouselListener = [];

// Initialise le carousel
const initCarousel = () => {
    for (const item of currentCarouselListener) {
        item.item.removeEventListener('click', item.listener);
    }

    currentCarouselListener = [];


    // pour chaque carousel
    for (let i = 0; i < carouselHtml.length; i++) {
        // on recupere le carousel
        const carousel = carouselHtml[i];
        // on recupere le nombre d'element a afficher en simultané
        const nbOfItem = carousel.getAttribute('carousel-display');

        // on recupere la liste des items du carousel
        const carouselItemsHtml = carousel.getElementsByClassName('carousel-item');
        // on recupere le container des items du carousel
        const carouselContainerHtml = carousel.getElementsByClassName('carousel-container');

        // on calcul la taille du container en fonction du nombre d'items et du nombre d'item a afficher
        const containerWidth = ((100 / nbOfItem) * carouselItemsHtml.length).toFixed(4);
        carouselContainerHtml[0].style.width = containerWidth + '%';
        carouselContainerHtml[0].style.left = '0%';
        // container d elements = affichage / nombre element afficher en meme temps * nombre element

        // container d elements =   100    /        nbOfItem                        * carouselItemsHtml.length

        // on recupere les bouton precedent, suivant
        const carouselBtn = carousel.getElementsByClassName('carousel-btn');
        for (let y = 0; y < carouselBtn.length; y++) {

            const func = () => {
                // on recupere la position actuel du container
                const currentValue = Number(carouselContainerHtml[0].style.left.replace('%', ''));
                // si on as cliquer sur le bouton suivant
                if (y == 1) {
                    // taille du container - taille du carousel (* -1 pour mettre en negatif)
                    const maxLeft = ((containerWidth - 100).toFixed(4) - 0.0001) * -1;
                    if (currentValue > maxLeft) {
                        carouselContainerHtml[0].style.left = currentValue - 100 / nbOfItem +
                            '%';
                    }
                    // si on as cliquer sur le bouton precedant
                } else {
                    // si la position actuelle et inferieure a 0 on peut le deplacer vers la droite
                    if (currentValue < 0) {
                        carouselContainerHtml[0].style.left = currentValue + 100 / nbOfItem +
                            '%';
                    }
                }
            };

            // au click sur un bouton
            carouselBtn[y].addEventListener('click', func);
            currentCarouselListener.push({
                item: carouselBtn[y],
                listener: func,
            });
        }
    }
}

// Initialise la largeur du carousel
const initWidthCarousel = (init = false) => {
    const numDisplay = domain.getAttribute("carousel-display");
    if (window.innerWidth <= 820) {
        if (init || numDisplay != '1') {
            domain.setAttribute("carousel-display", "1")
            initCarousel();
        }
    } else {
        if (init || numDisplay != '2') {
            domain.setAttribute("carousel-display", "2")
            initCarousel();
        }
    }
}

initWidthCarousel(true);

window.addEventListener('resize', () => {
    initWidthCarousel();
})


itemImg[0].addEventListener('click', () => {
    itemImg[0].classList.toggle('selected')
})