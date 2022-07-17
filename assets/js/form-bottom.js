const formDiv = document.getElementById("rotpg-entry-form");

const submittedDiv = document.getElementById("rotpg-submitted");

const errorDiv = document.getElementById("rotpg-error");

const duplicateDiv = document.getElementById("rotpg-duplicate");

const submitButton = document.getElementById("rotpg-submit");

Array.from(document.querySelectorAll(".js-back-btn")).forEach((btn) => {
    btn.addEventListener("click", (e) => {
        resetForm();
    });
});

resetForm();

function buildChiplists() {
    const genreChipData = {};

    for (var i in commonData.genres) {
        const g = commonData.genres[i];

        genreChipData[g.id] = g.name;
    }

    document.getElementById("rotpg-genres").setChips(genreChipData);

    const artistTypeChipData = {};

    for (var i in commonData.artistTypes) {
        const at = commonData.artistTypes[i];

        if (!Object.keys(at.genres).length) continue;

        artistTypeChipData[at.id] = at.name;
    }

    document.getElementById("rotpg-artist-types").setChips(artistTypeChipData);
}

buildChiplists();

submitButton.addEventListener("click", (e) => {
    const venueNameInput = document.getElementById("rotpg-venue-name");

    // const abnInput = document.getElementById('rotpg-abn');

    const firstNameInput = document.getElementById("rotpg-first-name");

    const lastNameInput = document.getElementById("rotpg-last-name");

    const phoneInput = document.getElementById("rotpg-phone");

    const emailInput = document.getElementById("rotpg-email");

    const whyInput = document.getElementById("rotpg-why");

    const stateInput = document.getElementById("rotpg-state");

    const artistTypesChiplist = document.getElementById("rotpg-artist-types");

    const genresChiplist = document.getElementById("rotpg-genres");

    const logoInput = document.getElementById("rotpg-logo");

    const venueImagesInput = document.getElementById("rotpg-venue-images");

    const termsToggle = document.getElementById("rotpg-terms-toggle");

    const termsError = document.getElementById("rotpg-terms-error");

    const redirection_url = document.getElementById("redirection-url").getAttribute("redirection-url");

    termsToggle.addEventListener("change", (e) => {
        if (termsToggle.checked) {
            termsError.classList.remove("error-message--show");
        }
    });

    if (validateFields()) {
        submitButton.setAttribute("loading", "");

        if (redirection_url) {
            window.open(redirection_url, "_self");
        }

        const venueImages = venueImagesInput.getValues();

        api_call(
            "/rotpg-entry.json",
            {
                venueName: venueNameInput.value,

                //abn: abnInput.value,

                firstName: firstNameInput.value,

                lastName: lastNameInput.value,

                phone: phoneInput.value,

                email: emailInput.value,

                why: whyInput.value,

                state_id: stateInput.value,

                artist_types: artistTypesChiplist.getValues().join(","),

                genres: genresChiplist.getValues().join(","),

                logo: logoInput.getValues()[0],

                image_0: venueImages[0],

                image_1: venueImages[1],

                image_2: venueImages[2],
            },
            (statusCode, statusMessage, data) => {
                submitButton.removeAttribute("loading");

                switch (statusCode) {
                    case 0:
                        hide(formDiv);

                        unhide(submittedDiv);

                        break;

                    case 1:

                    case 3:
                        hide(formDiv);

                        unhide(errorDiv);

                        break;

                    case 2:
                        hide(formDiv);

                        unhide(duplicateDiv);

                        break;
                }
            }
        );
    }

    function validateFields() {
        let isValid = true;

        if (isEmptyString(venueNameInput.value)) {
            venueNameInput.showError("Please enter the name of your venue");

            isValid = false;
        }

        //if (!validateAbn(abnInput.value)) {

        //abnInput.showError('Please enter ABN of your venue');

        //isValid = false;

        //}

        if (isEmptyString(firstNameInput.value)) {
            firstNameInput.showError("Please enter your first name");

            isValid = false;
        }

        if (isEmptyString(lastNameInput.value)) {
            lastNameInput.showError("Please enter your last name");

            isValid = false;
        }

        if (!validateMobile(phoneInput.value)) {
            phoneInput.showError("Please enter a valid phone number");

            isValid = false;
        }

        if (!validateEmail(emailInput.value)) {
            emailInput.showError("Please enter a valid email address");

            isValid = false;
        }

        if (isEmptyString(whyInput.value)) {
            whyInput.showError("Please tell us what you would do with RISE");

            isValid = false;
        }

        if (isEmptyString(stateInput.value)) {
            stateInput.showError("Please select your state");

            isValid = false;
        }

        if (!genresChiplist.getValues().length) {
            genresChiplist.showError("Please select at least one genre");

            isValid = false;
        }

        if (!artistTypesChiplist.getValues().length) {
            artistTypesChiplist.showError("Please select at least one artist type");

            isValid = false;
        }

        if (!termsToggle.checked) {
            termsError.classList.add("error-message--show");

            isValid = false;
        }

        return isValid;
    }
});

function resetForm() {
    hide(submittedDiv);

    hide(errorDiv);

    hide(duplicateDiv);

    unhide(formDiv);
}
