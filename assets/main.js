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