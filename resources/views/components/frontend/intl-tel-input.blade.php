<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.min.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>

<script>
    window._phoneInputs = window._phoneInputs || {};

    function loadPhoneInput(selector = "#phone") {
        const input = document.querySelector(selector);
        if (!input) return null;

        if (input.dataset.itiInitialized === "true") return window._phoneInputs[selector];

        const iti = window.intlTelInput(input, {
            initialCountry: "auto",
            nationalMode: false,
            formatOnDisplay: false,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js",
            geoIpLookup: function (success) {
                fetch("https://ipapi.co/json/")
                    .then(r => r.json())
                    .then(d => success(d.country_code))
                    .catch(() => success("IN"));
            }
        });

        window._phoneInputs[selector] = iti;
        input.dataset.itiInitialized = "true";
        input.dataset.itiReady = "false";

        iti.promise.then(() => {
            input.dataset.itiReady = "true";
            console.log("☎️ IntlTelInput Ready for", selector);

            // Trigger validation on input or country change
            const triggerValidation = () => {
                if (window.contactFormValidator) {
                    window.contactFormValidator.validateField(selector);
                }
            };

            input.addEventListener("input", () => {
                const cursorPos = input.selectionStart;
                input.value = input.value.replace(/\s+/g, "");
                input.setSelectionRange(cursorPos, cursorPos);
            });

            input.addEventListener("input", triggerValidation);
            input.addEventListener("countrychange", triggerValidation);
        });

        return iti;
    }
</script>