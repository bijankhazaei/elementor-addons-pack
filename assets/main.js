window.addEventListener('elementor/frontend/init', (e) => {
    const countries = document.querySelectorAll('.eap-countries-widget-item');
    const countriesInMobile = document.querySelectorAll('.eap-widget-item-mobile');
    const mapContainer = document.getElementById("mapContainer");
    let modal = null;
    let selectedPath = null;

    countries.forEach(country => {
        let countryId = null;

        country.addEventListener('mouseover', () => {
            countryId = country.getAttribute('data-country_id')
            country.classList.add('active');

            modal = document.getElementById('country_' + countryId);

            selectedPath = document.getElementById(countryId);
            selectedPath.classList.add('active');
            const {x, y, width, height} = selectedPath.getBBox();

            if (x < mapContainer.offsetWidth / 4) {
                modal.style.left = width + 50 + "px";
            } else {
                modal.style.left = x - 200 + "px";
            }

            modal.style.top = y + "px";
            modal.style.display = "block";
            modal.style.opacity = "1";
        })

        country.addEventListener('mouseout', () => {
            modal.style.opacity = "0";
            modal.style.display = "none";

            country.classList.remove('active');
            countryId = null;

            selectedPath.classList.remove('active');
        })
    });

    countriesInMobile.forEach(country => {
        let countryId = null;

        country.addEventListener('click', (e) => {
            console.log(e);
            countryId = country.getAttribute('data-country_id')
            const countryAccordion = document.getElementById('country_accordion_' + countryId);
            const allCountryAccordions = document.querySelectorAll('.country-accordion');

            countriesInMobile.forEach(country => {
                country.classList.remove('active-mobile');
            })

            e.currentTarget.classList.toggle('active-mobile');

            countryAccordion.classList.toggle('active');
            allCountryAccordions.forEach(accordion => {
                if (accordion.id === countryAccordion.id) return;
                accordion.classList.remove('active');
            })
        })
    });
})

const countryNewsTabLinks = document.querySelectorAll('.eap-country-news-tab-link');

countryNewsTabLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const target = e.currentTarget.getAttribute('href');
        const targetElement = document.querySelector(target);
        const allTabs = document.querySelectorAll('.eap-country-news-tab');

        countryNewsTabLinks.forEach(link => {
            link.classList.remove('selected');
        })

        e.currentTarget.classList.add('selected');

        allTabs.forEach(tab => {
            tab.classList.remove('selected');
        })

        targetElement.classList.add('selected');
    })
})

const isMobile = window.matchMedia("only screen and (max-width: 768px)").matches;

console.log('isMobile', isMobile)

const eapCountrySliders = document.getElementById("eapCountrySlider").getAttribute('data-sliders')

let perPage = isMobile ? 3.5 : 7.5;

if( eapCountrySliders < 8 && eapCountrySliders > 3) {
    perPage = isMobile ? 3.5 : eapCountrySliders - 0.5
}

if ( eapCountrySliders < 4) {
    perPage = 3
}

console.log('perPage', perPage);

console.log('eapCountrySliders', eapCountrySliders);
// Create a new instance of KeenSlider
function navigation(slider) {
    let wrapper, arrowLeft, arrowRight

    function markup(remove) {
        arrowMarkup(remove)
    }

    function removeElement(elment) {
        elment.parentNode.removeChild(elment)
    }

    function createDiv(className) {
        const div = document.createElement("div");
        const classNames = className.split(" ")
        classNames.forEach((name) => div.classList.add(name))
        return div
    }

    function arrowMarkup(remove) {
        if (remove) {
            removeElement(arrowLeft)
            removeElement(arrowRight)
            return
        }

        wrapper = document.getElementById('navigationWrapper')

        arrowLeft = createDiv("arrow arrow--left")
        arrowLeft.addEventListener("click", () => slider.next())

        arrowRight = createDiv("arrow arrow--right")
        arrowRight.addEventListener("click", () => slider.prev())

        wrapper.appendChild(arrowLeft)
        wrapper.appendChild(arrowRight)
    }

    function updateClasses() {
        const slide = slider.track.details.rel;
        console.log('slide', slide);
        console.log("Slider Length", slider.track.details.slides.length)
        console.log("math", slider.track.details.slides.length - Math.round(perPage))
        console.log("perPage", perPage)

        if (perPage <= 3) {
            arrowLeft.classList.add("arrow--disabled")
        } else  {
            slide === Math.ceil(slider.track.details.slides.length / Math.round(perPage))
                ? arrowLeft.classList.add("arrow--disabled")
                : arrowLeft.classList.remove("arrow--disabled")
        }


        slide === 0
            ? arrowRight.classList.add("arrow--disabled")
            : arrowRight.classList.remove("arrow--disabled")
    }

    slider.on("created", () => {
        markup()
        updateClasses()
    })

    slider.on("optionsChanged", () => {
        markup(true)
        markup()
        updateClasses()
    })

    slider.on("slideChanged", () => {
        updateClasses()
    })

    slider.on("destroyed", () => {
        markup(true)
    })
}



if (eapCountrySliders > 1) {
    new KeenSlider("#eapCountrySlider", {
        loop: false,
        rtl: true,
        slides: {perView: perPage, spacing: 0},
    }, [navigation])
}