window.addEventListener('elementor/frontend/init', (e) => {
    const countries = document.querySelectorAll('.eap-countries-widget-item');
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
})

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
        console.log(slide);
        console.log(slider.track.details.slides.length);
        slide === slider.track.details.slides.length - 7
            ? arrowLeft.classList.add("arrow--disabled")
            : arrowLeft.classList.remove("arrow--disabled")

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

new KeenSlider("#eapCountrySlider", {
    loop: false,
    rtl: true,
    slides: {perView: 7.5, spacing: 0},
}, [navigation])