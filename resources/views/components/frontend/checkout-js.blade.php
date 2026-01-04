<script>
    document.addEventListener("DOMContentLoaded", () => {
        loadPhoneInput("#billing_phone");
        loadPhoneInput("#shipping_phone");
        const rules = [
            // Auth / User
            { selector: "#email", rule: "email" },
            { selector: "#password", rule: "password" },

            // Billing
            { selector: "#billing_first_name", rule: "billing_first_name" },
            { selector: "#billing_last_name", rule: "billing_last_name" },
            { selector: "#billing_address_line1", rule: "billing_address_line1" },
            { selector: "#billing_city", rule: "billing_city" },
            { selector: "#billing_state", rule: "billing_state" },
            { selector: "#billing_phone", rule: "billing_phone" },
            { selector: "#billing_zip", rule: "billing_zip" },

            // Shipping (conditional)
            { selector: "#shipping_first_name", rule: "shipping_first_name" },
            { selector: "#shipping_last_name", rule: "shipping_last_name" },
            { selector: "#shipping_address_line1", rule: "shipping_address_line1" },
            { selector: "#shipping_city", rule: "shipping_city" },
            { selector: "#shipping_state", rule: "shipping_state" },
            { selector: "#shipping_phone", rule: "shipping_phone" },
            { selector: "#shipping_zip", rule: "shipping_zip" },

            { selector: "#order_notes", rule: "order_notes" },
        ];


        setTimeout(() => {
            initFormValidator("#checkoutForm", rules);
        }, 500)




    });

    document.addEventListener("DOMContentLoaded", () => {
        const rules = [
            { selector: "#login_email", rule: "email" },
            { selector: "#login_password", rule: "password" },
            //{ selector: "#tnc", rule: "tnc" }
        ];
        setTimeout(() => {
            initFormValidator("#checkoutLoginForm", rules);
        }, 500)

    });
    document.querySelector('#differentShipping')?.addEventListener('change', e => {
        document.querySelectorAll('[id^="shipping_"]').forEach(el => {
            el.disabled = !e.target.checked;
            if (!e.target.checked) el.value = '';
        });
    });
</script>