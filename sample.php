
.nfpl_js_style_input_container {
    display: flex;
    align-items: center;
    border: 1px solid #b4b4b4;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    background: #fff;
}

.nfpl_js_style_input_label {
    padding: 0.5rem;
    color: #666;
    display: flex;
    align-items: center;
}

.nfpl_js_style_input_field {
    flex: 1;
    padding: 0.75rem;
    border: none;
    outline: none;
    font-size: 1rem;
    width: 100%;
}

.custom-dropdown {
    display: flex;
    align-items: center;
    min-width: 90px;
    margin-right: 10px;
}

.dropdown-list {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 0.3rem;
    z-index: 1000;
}

.nfpl_js_style_checkbox_label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
}

.checkbox-field {
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.nfpl_js_style_custom_select select {
    appearance: none;
    background: transparent;
    width: 100%;
    padding-right: 2rem;
    cursor: pointer;
}

.nfpl_js_style_custom_select::after {
    content: '▼';
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
}

textarea {
    width: 100%;
    border: 1px solid #b4b4b4;
    border-radius: 0.5rem;
    resize: vertical;
}

.btn-primary {
    background: #007bff;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    width: 100%;
    font-size: 1rem;
    margin-top: 1rem;
}

.btn-primary:hover {
    background: #0056b3;
}

h5 {
    margin: 1.5rem 0 1rem;
    font-weight: 600;
}

.nfpl_js_styles_d_none {
    display: none;
}

/* Responsive Grid Layout */
@media (min-width: 768px) {
    div[class^="booking-"] {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .full-width {
        grid-column: 1 / -1;
    }
}

@media (max-width: 767px) {
    .nfpl_js_style_input_container {
        margin-bottom: 0.75rem;
    }

    .btn-primary {
        padding: 0.75rem 1.5rem;
    }
}

/* Custom scrollbar for dropdowns */
.dropdown-list::-webkit-scrollbar {
    width: 6px;
}

.dropdown-list::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.dropdown-list::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

/* Error states */
.input-error {
    border-color: #dc3545;
}

p[id$="Error"] {
    margin-top: -0.5rem;
    margin-bottom: 0.5rem;
}

/* Success states */
p[id$="Success"] {
    margin-top: -0.5rem;
    margin-bottom: 0.5rem;
}

/* Voucher section */
#nfpl_js_style_Apply_voucher_button {
    background: #198754;
    color: white;
    border: none;
    border-radius: 0.3rem;
    padding: 0.5rem 1rem;
    cursor: pointer;
}

#nfpl_js_style_Apply_voucher_button:hover {
    background: #146c43;
}

#nfpl_js_style_submitPassengerInfo{
    color: var(--var-button-text);
    background-color: var(--var-button-color);
    border: none;
    padding: 0.6rem 0.5rem;
    width: 100%;
    border-radius: 0.4rem;
}































.custom-dropdown {
    max-width: 100px;
    margin-right: 5px;
}


#nfpl_js_style_searchCountryCode_customer {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    font-size: 14px;
}

#nfpl_js_style_searchCountryCode_passenger {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
    font-size: 14px;
}











.dropdown-list {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    max-height: 200px;
    overflow-y: auto;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    z-index: 1000;
    display: none;
    /* Hidden by default */
}

.dropdown-list div {
    padding: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.dropdown-list div:hover {
    background-color: #f1f1f1;
}

.flag-icon {
    width: 20px;
    height: 15px;
    margin-right: 10px;
    vertical-align: middle;
}


