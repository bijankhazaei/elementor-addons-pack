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

            const mapWidth = mapContainer.offsetWidth;
            const mapRect = mapContainer.getBoundingClientRect();
            const selectedPathRect = selectedPath.getBoundingClientRect();


            if (Math.abs(selectedPathRect.left - mapRect.left) < 50) {
                modal.style.left = selectedPathRect.right + "px";
                modal.style.right = "auto";
                modal.style.top = selectedPathRect.top + "px";
            } else {
                modal.style.top = selectedPathRect.top + "px";
                modal.style.right = Number.parseInt(selectedPathRect.left.toString()) + 10 + "px";
                modal.style.left = "auto";
            }


            modal.style.display = "block";
            modal.style.opacity = "1";

            console.log('modal right: ' + modal.style.right , 'modal left: ' + modal.style.left, 'path left' + selectedPathRect.left , 'path right' + selectedPathRect.right)
            console.log('modal rec right:' + modal.getBoundingClientRect().right , 'modal rec left: ' + modal.getBoundingClientRect().left)
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