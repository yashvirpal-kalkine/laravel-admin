import JustValidate from "just-validate";


// ---------------------
// Global validation rules
// ---------------------
export const ValidationRules = {
    name: [
        { rule: "required", errorMessage: "Name is required" },
        { rule: "minLength", value: 3, errorMessage: "Minimum 3 characters required" },
        { rule: "maxLength", value: 25, errorMessage: "Maximum 25 characters allowed" },
    ],
    email: [
        { rule: "required", errorMessage: "Email is required" },
        { rule: "email", errorMessage: "Enter a valid email" },
    ],
    password: [
        { rule: "required", errorMessage: "Password is required" },
        { rule: "password", errorMessage: "Password must contain at least 8 characters, letters and numbers" },
    ],
    password_confirmation: [
        { rule: "required", errorMessage: "Confirm your password" },
        {
            validator: (value, fields) => value === fields['#password'].elem.value,
            errorMessage: "Passwords do not match"
        }
    ],
    message: [
        { rule: 'required' },
        { rule: 'minLength', value: 5 }
    ],
    phone: [
        { rule: "required", errorMessage: "Phone is required" },
        //{ rule: "minLength", value: 7, errorMessage: "Minimum 7 characters required" },
        //{ rule: "maxLength", value: 15, errorMessage: "Maximum 15 characters allowed" },
        // { rule: "number", errorMessage: "Value should be a number" },

        // {
        //     rule: "function",
        //     validator: (value, fields) => {
        //         const input = fields["#phone"]?.elem;
        //         if (!input) return false;

        //         const iti = input.intlTelInputInstance || window._phoneInputs?.["#phone"];
        //         if (!iti) return false;

        //         // Ensure utils.js is loaded
        //         if (input.dataset.itiReady !== "true") return false;

        //         if (!input.value.trim()) return false;

        //         // Get E164 number safely without directly using intlTelInputUtils
        //         const number = iti.getNumber(); // default format
        //         if (!number) return false;

        //         // Check validity
        //         return iti.isValidNumber() === true;
        //     },
        //     errorMessage: "Enter a valid phone number"
        // }
        {
            rule: "function",
            validator: (value, fields) => {
                const input = fields["#phone"]?.elem;
                if (!input) return false;

                const iti = input.intlTelInputInstance || window._phoneInputs?.["#phone"];
                if (!iti) return false;

                if (input.dataset.itiReady !== "true") return false;

                const number = iti.getNumber(); // E.164 format
                if (!number) return false;

                return iti.isValidNumber() === true;
            },
            errorMessage: "Enter a valid phone number"
        }
        ,
    ],
    tnc: [
        {
            validator: () => {
                const checkbox = document.querySelector("#tnc");
                return checkbox && checkbox.checked;
            },
            errorMessage: "You must accept the Terms & Conditions"
        }
    ]
};



// ---------------------
// Input restriction patterns
// ---------------------
const RestrictionPatterns = {
    phone: /^[0-9+]*$/,
    name: /^[a-zA-Z\s]*$/,
    number: /^[0-9]*$/,
    integer: /^[0-9]*$/,
    decimal: /^[0-9.]*$/,
    alpha: /^[a-zA-Z]*$/,
    alphanumeric: /^[a-zA-Z0-9]*$/,
};

/**
 * Restrict input by type with optional min/max length
 * @param {string} selector - CSS selector
 * @param {string} type - input type
 * @param {number} minLength - minimum characters (optional)
 * @param {number} maxLength - maximum characters (optional)
 */
export function restrictInputByType(selector, type, minLength = 0, maxLength = Infinity) {
    const regex = RestrictionPatterns[type];
    if (!regex) return;

    document.querySelectorAll(selector).forEach(input => {
        input.addEventListener("keypress", e => {
            const char = String.fromCharCode(e.which);
            if (!regex.test(char)) {
                e.preventDefault();
                return;
            }
            if (input.value.length >= maxLength) {
                e.preventDefault();
            }
        });

        input.addEventListener("paste", e => {
            const paste = (e.clipboardData || window.clipboardData).getData("text");
            if (!regex.test(paste)) {
                e.preventDefault();
                return;
            }
            if ((input.value + paste).length > maxLength) {
                e.preventDefault();
            }
        });
    });
}


// ---------------------
// Initialize validator for a form explicitly
// ---------------------
/**
 * formSelector: string => form CSS selector
 * fields: array of objects => [{ selector: "#email", rule: "email" }, { selector: "#password", rule: "password" }]
 * onSuccessCallback: function
 */
export function initFormValidator(formSelector, fields = [], onSuccessCallback = null) {
    const form = document.querySelector(formSelector);
    if (!form) return;

    const validator = new JustValidate(formSelector, {
        focusInvalidField: true,
        validateBeforeSubmitting: true,
        errorLabelStyle: { color: "#e3342f", fontSize: "14px" }
    });

    // Add field validation rules
    fields.forEach(f => {
        const rules = ValidationRules[f.rule];
        if (!rules) return;
        validator.addField(f.selector, rules);
    });

    // GLOBAL AJAX SUBMIT (runs only when all fields are VALID)
    validator.onSuccess(function (event) {
        event.preventDefault();
        console.log(event)
        const formElement = event.target;
        const $form = $(formElement);
        const formId = $form.attr("id");
        const formData = $form.serialize();
        const formActionUrl = $form.attr("action");
        console.log(formActionUrl)
        $.ajax({
            url: formActionUrl,
            method: $form.attr("method") || "POST",
            data: formData,
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                "X-Requested-With": "XMLHttpRequest",
                "Accept": "application/json"
            },
            beforeSend: function () {
                showLoader();
            },
            success: function (response) {
                hideLoader();
                if (response.message) {
                    $form.find(".msg").text(response.message).addClass("text-success");
                }
                if (response.redirect_url) {
                    setTimeout(() => window.location.href = response.redirect_url, 2500);
                }
                setTimeout(() => {
                    $form.find(".error,.msg").empty();
                }, 5000);
            },
            error: function (xhr) {
                hideLoader();
                if (xhr.status === 419) {
                    // $form.find(".msg").text(xhr.responseJSON?.message || 'Session expired. Please refresh the page.').addClass("text-red-600");
                    return;
                }
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;

                    for (const field in errors) {
                        $form.find(" .error_" + field).text(errors[field][0]);
                    }
                } else {
                    $form.find(".msg").text(xhr.responseJSON.message).addClass("text-danger");
                }
                setTimeout(() => {
                    $form.find(".error,.msg").empty();
                }, 5000);
            }
        });

    });

    return validator;
}


// Show loader
export function showLoader() {
    const loader = document.getElementById('ajax-loader');
    if (loader) loader.classList.remove('hidden');
}

// Hide loader
export function hideLoader() {
    const loader = document.getElementById('ajax-loader');
    if (loader) loader.classList.add('hidden');
}

