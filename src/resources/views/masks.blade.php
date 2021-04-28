@push("css")
    {{-- DateRangePicker v3.14.1 --}}
    <link rel="stylesheet" href="{{ asset('vendor/input-customizer/css/daterangepicker.min.css') }}">

    {{-- SweetAlert2 v9.8.2 --}}
    <link rel="stylesheet" href="{{ asset('vendor/input-customizer/css/sweetalert2.min.css') }}">

    {{-- Masks --}}
    <style type="text/css">
        .swal2-popup {
            font-size: 24px;
            width: 480px;
            padding: 20px;
        }
        .swal2-icon {
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .swal2-title {
            font-size: 20px;
            margin-bottom: 5px;
        }
        .swal2-content {
            font-size: 16px;
            line-height: 120%;
            margin-bottom: 0;
        }
        .swal2-actions {
            margin-top: 20px;
            margin-bottom: 0;
        }
        .swal2-confirm {
            margin: 0 2.5px;
        }
        .swal2-cancel {
            margin: 0 2.5px;
        }
        .swal2-close {
            font-size: 18px;
            font-weight: bold;
            margin: 4px 4px 0 0;
        }
        .swal2-close:focus {
            outline: none;
        }
        .drp-calendar {
            width: 300px;
        }
    </style>
@endpush

@push("js")
    {{-- Moment v2.24.0 --}}
    <script src="{{ asset('vendor/input-customizer/js/moment-with-locales.min.js') }}"></script>
    
    {{-- DateRangePicker v3.14.1 --}}
    <script src="{{ asset('vendor/input-customizer/js/daterangepicker.min.js') }}"></script>

    {{-- Inputmask v4.0.3-beta.1 --}}
    <script src="{{ asset('vendor/input-customizer/js/jquery.inputmask.bundle.js') }}"></script>

    {{-- jQuery MaskMoney v3.1.1 --}}
    <script src="{{ asset('vendor/input-customizer/js/jquery.maskMoney.min.js') }}"></script>

    {{-- SweetAlert2 v9.8.2 --}}
    <script src="{{ asset('vendor/input-customizer/js/sweetalert2.min.js') }}"></script>

    {{-- Masks --}}
    <script type="text/javascript">
        // Control Variables
        let dateRangePickerLocale = {
            firstDay: 0,
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "De",
            toLabel: "Até",
            customRangeLabel: "Personalizado",
            weekLabel: "S",
            daysOfWeek: [
                "Dom",
                "2ª",
                "3ª",
                "4ª",
                "5ª",
                "6ª",
                "Sab"
            ],
            monthNames: [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
        };
        let ignoreOnInitialFocus = ".datetime-mask, .datetime-blockpast-mask, .datetime-blockfuture-mask, .date-mask, .date-blockpast-mask, .date-blockfuture-mask, .time-mask, .time-blockpast-mask, .time-blockfuture-mask, .two-digits-month-year-mask, .two-digits-month-year-blockpast-mask, .two-digits-month-year-blockfuture-mask, .duration-mask";
        // Money
        $(".money-mask").each(function(){
            let value = $(this).val();
            if (value.indexOf(",")===-1) {
                $(this).val(value.replace(".",","));
            }
        });
        $(document).on("focus", ".money-mask:not([readonly])", function(){
            $(this).attr("maxLength", 24);
            $(this).maskMoney({
                "prefix": "R$ ",
                "thousands": ".",
                "decimal": ",",
                "precision": 2,
                "allowZero": true,
                "allowNegative": true,
                "allowEmpty": true
            });
        });
        $(document).on("submit", "form", function(e){
            // Non-array inputs
            $(".money-mask:enabled").not("[name$='[]']").each(function(){
                let value = ($(this).val())? $(this).maskMoney("unmasked")[0] : "";
                $("form").append(`<input type="hidden" name="${$(this).attr("name")}" value=${value}>`);
            });
            // Array inputs
            let inputNamesArray = [];
            $(".money-mask:enabled[name$='[]']").each(function(){
                let inputName = $(this).attr("name");
                if (!inputNamesArray.includes(inputName)) {
                    inputNamesArray.push(inputName);
                } 
            });
            inputNamesArray.forEach(function(inputName){
                let baseName = inputName.replace("[]", "");
                $(`input[name="${inputName}"]`).each(function(i){
                    let value = ($(this).val())? $(this).maskMoney("unmasked")[0] : "";
                    $("form").append(`<input type="hidden" name="${baseName}[${i}]" value=${value}>`);
                });
            }); 
        });
        // Float
        $(document).on("focus", ".float-mask", function(){
            $(this).inputmask("numeric", {
                "placeholder": "",
                "rightAlign": false,
                "integerDigits": 6,
                "digits": 2,
                "digitsOptional": true,
                "groupSeparator": ".",
                "radixPoint": ",",
                "autoGroup": true,
                "allowMinus": true,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "unmaskAsNumber": true,
                "showMaskOnHover": false,
                // Fix for starting with negative decimal
                "onKeyDown": function(event, buffer, _caretPos, _opts) {
                    var currentValue = buffer.length == 2 ? buffer[0] : "";
                    if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) $(event.currentTarget).val("-0..");
                }
            });
        });
        // Double
        $(document).on("focus", ".double-mask", function(){
            $(this).inputmask("numeric", {
                "placeholder": "",
                "rightAlign": false,
                "integerDigits": 14,
                "digits": 2,
                "digitsOptional": true,
                "groupSeparator": ".",
                "radixPoint": ",",
                "autoGroup": true,
                "allowMinus": true,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "unmaskAsNumber": true,
                "showMaskOnHover": false,
                // Fix for starting with negative decimal
                "onKeyDown": function(event, buffer, _caretPos, _opts) {
                    var currentValue = buffer.length == 2 ? buffer[0] : "";
                    if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) $(event.currentTarget).val("-0..");
                }
            });
        });
        // Integer
        $(document).on("focus", ".integer-mask", function(){
            $(this).inputmask("numeric", {
                "placeholder": "",
                "rightAlign": false,
                "integerDigits": 6,
                "digits": 0,
                "groupSeparator": ".",
                "radixPoint": ",",
                "autoGroup": true,
                "allowMinus": true,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "unmaskAsNumber": true,
                "showMaskOnHover": false,
                // Fix for starting with negative decimal
                "onKeyDown": function(event, buffer, _caretPos, _opts) {
                    var currentValue = buffer.length == 2 ? buffer[0] : "";
                    if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) $(event.currentTarget).val("-0..");
                }
            });
        });
        // Zero to Ten
        $(document).on("focus", ".zero-to-ten-mask", function(){
            $(this).inputmask("numeric", {
                "placeholder": "",
                "rightAlign": false,
                "integerDigits": 2,
                "min": 0,
                "max": 10,
                "digits": 0,
                "autoGroup": true,
                "allowMinus": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "unmaskAsNumber": true,
                "showMaskOnHover": false
            });
        });
        // Percentage
        $(document).on("focus", ".percentage-mask", function(){
            $(this).inputmask("numeric", {
                "placeholder": "",
                "rightAlign": false,
                "integerDigits": 3,
                "min": 0,
                "max": 100,
                "digits": 2,
                "digitsOptional": true,
                "groupSeparator": ".",
                "radixPoint": ",",
                "autoGroup": true,
                "allowMinus": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "showMaskOnHover": false,
                // Fix decimal point on unmask
                "onUnMask": function(maskedValue, _unmaskedValue) {
                    var x = maskedValue.split(",");
                    if (x[1] === undefined) return x[0].replace(/\./g, "");
                    else return x[0].replace(/\./g, "") + "." + x[1];
                }
            });
        });
        // Latitude
        $(document).on("focus", ".latitude-mask", function(){
            $(this).inputmask("numeric", {
                "placeholder": "",
                "rightAlign": false,
                "integerDigits": 2,
                "min": -90,
                "max": 90,
                "digits": 8,
                "digitsOptional": true,
                "groupSeparator": ".",
                "radixPoint": ",",
                "autoGroup": true,
                "allowMinus": true,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "unmaskAsNumber": true,
                "showMaskOnHover": false,
                // Fix for starting with negative decimal
                "onKeyDown": function(event, buffer, _caretPos, _opts) {
                    var currentValue = buffer.length == 2 ? buffer[0] : "";
                    if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) $(event.currentTarget).val("-0..");
                }
            });
        });
        // Longitude
        $(document).on("focus", ".longitude-mask", function(){
            $(this).inputmask("numeric", {
                "placeholder": "",
                "rightAlign": false,
                "integerDigits": 3,
                "min": -180,
                "max": 180,
                "digits": 8,
                "digitsOptional": true,
                "groupSeparator": ".",
                "radixPoint": ",",
                "autoGroup": true,
                "allowMinus": true,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "unmaskAsNumber": true,
                "showMaskOnHover": false,
                // Fix for starting with negative decimal
                "onKeyDown": function(event, buffer, _caretPos, _opts) {
                    var currentValue = buffer.length == 2 ? buffer[0] : "";
                    if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) $(event.currentTarget).val("-0..");
                }
            });
        });
        // Document
        $(document).on("focus", ".document-mask", function(){
            $(this).inputmask("text", {
                "mask": ["999.999.999-99", "99.999.999/9999-99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um CPF no formato <u>999.999.999-99</u> ou um CNPJ no formato <u>99.999.999/9999-99</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
            });
        });
        // CPF
        $(document).on("focus", ".cpf-mask", function(){
            $(this).inputmask("text", {
                "mask": ["999.999.999-99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um CPF no formato <u>999.999.999-99</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
            });
        });
        // CNPJ
        $(document).on("focus", ".cnpj-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99.999.999/9999-99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um CNPJ no formato <u>99.999.999/9999-99</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
            });
        });
        // National ID
        $(document).on("focus", ".national-id-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99.999.999-9", "AA-99.999.999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um RG no formato <u>99.999.999-9</u> ou <u>AA-99.999.999</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        // Phone
        $(document).on("focus", ".phone-mask", function(){
            $(this).inputmask("text", {
                "mask": ["(99) 9999-9999", "(99) 99999-9999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um telefone no formato <u>(99) 9999-9999</u> ou <u>(99) 99999-9999</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        // Datetime
        $(document).on("focus", ".datetime-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99/9999 99:99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data e hora no formato <u>dd/mm/aaaa hh:mm</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "DD/MM/YYYY HH:mm", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("DD/MM/YYYY HH:mm");
                    }
                }
            });
            dateRangePickerLocale.format = "DD/MM/YYYY HH:mm";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
            });
        });
        // Datetime Blockpast
        $(document).on("focus", ".datetime-blockpast-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99/9999 99:99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data e hora, posterior ao momento atual, no formato <u>dd/mm/aaaa hh:mm</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "DD/MM/YYYY HH:mm", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("DD/MM/YYYY HH:mm");
                    }
                }
            });
            dateRangePickerLocale.format = "DD/MM/YYYY HH:mm";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                minDate: moment(),
            });
        });
        // Datetime Blockfuture
        $(document).on("focus", ".datetime-blockfuture-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99/9999 99:99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data e hora, anterior ao momento atual, no formato <u>dd/mm/aaaa hh:mm</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "DD/MM/YYYY HH:mm", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("DD/MM/YYYY HH:mm");
                    }
                }
            });
            dateRangePickerLocale.format = "DD/MM/YYYY HH:mm";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                maxDate: moment(),
            });
        });
        // Date
        $(document).on("focus", ".date-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99/9999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data no formato <u>dd/mm/aaaa</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "DD/MM/YYYY", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("DD/MM/YYYY");
                    }
                }
            });
            dateRangePickerLocale.format = "DD/MM/YYYY";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
            });
        });
        // Date Blockpast
        $(document).on("focus", ".date-blockpast-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99/9999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data, posterior à atual, no formato <u>dd/mm/aaaa</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "DD/MM/YYYY", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("DD/MM/YYYY");
                    }
                }
            });
            dateRangePickerLocale.format = "DD/MM/YYYY";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                minDate: moment(),
            });
        });
        // Date Blockfuture
        $(document).on("focus", ".date-blockfuture-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99/9999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data, anterior à atual, no formato <u>dd/mm/aaaa</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "DD/MM/YYYY", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("DD/MM/YYYY");
                    }
                }
            });
            dateRangePickerLocale.format = "DD/MM/YYYY";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                maxDate: moment(),
            });
        });
        // Time
        $(document).on("focus", ".time-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99:99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma hora no formato <u>hh:mm</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "HH:mm", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("HH:mm");
                    }
                }
            });
            dateRangePickerLocale.format = "HH:mm";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: false,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
            }).on("showCalendar.daterangepicker", (ev, picker) => {
                $(".calendar-time").css("margin-top", 0);
                $(".calendar-table").css("visibility", "collapse");
            });
        });
        // Time Blockpast
        $(document).on("focus", ".time-blockpast-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99:99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma hora, posterior à atual, no formato <u>hh:mm</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "HH:mm", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("HH:mm");
                    }
                }
            });
            dateRangePickerLocale.format = "HH:mm";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: false,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                minDate: moment(),
            }).on("showCalendar.daterangepicker", (ev, picker) => {
                $(".calendar-time").css("margin-top", 0);
                $(".calendar-table").css("visibility", "collapse");
            });
        });
        // Time Blockfuture
        $(document).on("focus", ".time-blockfuture-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99:99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma hora, anterior à atual, no formato <u>hh:mm</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onUnMask": function(maskedValue, unmaskedValue) {
                    let dbFormat = moment(maskedValue, "HH:mm", true).format("YYYY-MM-DD HH:mm:ss");
                    return (dbFormat==="Invalid date")? null : dbFormat;
                },
                "onBeforeMask": function (value, opts) {
                    if (value.includes("-")) {
                        return moment(value, "YYYY-MM-DD HH:mm:ss", true).format("HH:mm");
                    }
                }
            });
            dateRangePickerLocale.format = "HH:mm";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: false,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                maxDate: moment(),
            }).on("showCalendar.daterangepicker", (ev, picker) => {
                $(".calendar-time").css("margin-top", 0);
                $(".calendar-table").css("visibility", "collapse");
            });
        });
        // Two Digits Day
        $(document).on("focus", ".two-digits-day-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value && (this.value < 1 || this.value > 31)) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe o número do dia, de 1 a 31.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "oncomplete": function() {
                    if (this.value < 1 || this.value > 31) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe o número do dia, de 1 a 31.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onBeforeWrite": function (event, buffer) {
                    if (event.type === "blur") {
                        if (buffer[1] == "_") {
                            buffer[1] = buffer[0];
                            buffer[0] = "0";
                            return {
                                refreshFromBuffer: true,
                                buffer: buffer
                            };
                        }
                    }
                }
            });
        });
        // Two Digits Month
        $(document).on("focus", ".two-digits-month-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value && (this.value < 1 || this.value > 12)) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um mês no formato <u>mm</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "oncomplete": function() {
                    if (this.value < 1 || this.value > 12) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe o número do mês, de 1 a 12.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onBeforeWrite": function (event, buffer) {
                    if (event.type === "blur") {
                        if (buffer[1] == "_") {
                            buffer[1] = buffer[0];
                            buffer[0] = "0";
                            return {
                                refreshFromBuffer: true,
                                buffer: buffer
                            };
                        }
                    }
                }
            });
        });
        // Two Digits Year
        $(document).on("focus", ".two-digits-year-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value && (this.value < 1 || this.value > 99)) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um mês no formato <u>aa</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "oncomplete": function() {
                    if (this.value < 1 || this.value > 99) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe o número do ano, de 1 a 99.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                },
                "onBeforeWrite": function (event, buffer) {
                    if (event.type === "blur") {
                        if (buffer[1] == "_") {
                            buffer[1] = buffer[0];
                            buffer[0] = "0";
                            return {
                                refreshFromBuffer: true,
                                buffer: buffer
                            };
                        }
                    }
                }
            });
        });
        // Two Digits Month and Year
        $(document).on("focus", ".two-digits-month-year-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data no formato <u>mm/aa</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
            dateRangePickerLocale.format = "MM/YY";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
            }).on("showCalendar.daterangepicker", (ev, picker) => {
                $(".table-condensed thead tr:nth-child(2), .table-condensed tbody").hide();
                let start = moment((parseInt($(".left .monthselect").val()) + 1) + "/01/" + $(".left .yearselect").val())
                let end = moment((parseInt($(".right .monthselect").val()) + 1) + "/01/" + $(".right .yearselect").val())
                $(this).data("daterangepicker").setStartDate(start);
                $(this).data("daterangepicker").setEndDate(end);
            });
        });
        // Two Digits Month and Year Blockpast
        $(document).on("focus", ".two-digits-month-year-blockpast-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data no formato <u>mm/aa</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
            dateRangePickerLocale.format = "MM/YY";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                minDate: moment(),
            }).on("showCalendar.daterangepicker", (ev, picker) => {
                $(".table-condensed thead tr:nth-child(2), .table-condensed tbody").hide();
                let start = moment((parseInt($(".left .monthselect").val()) + 1) + "/01/" + $(".left .yearselect").val())
                let end = moment((parseInt($(".right .monthselect").val()) + 1) + "/01/" + $(".right .yearselect").val())
                $(this).data("daterangepicker").setStartDate(start);
                $(this).data("daterangepicker").setEndDate(end);
            });
        });
        // Two Digits Month and Year Blockfuture
        $(document).on("focus", ".two-digits-month-year-blockfuture-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99/99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma data no formato <u>mm/aa</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
            dateRangePickerLocale.format = "MM/YY";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                timePicker: false,
                timePicker24Hour: false,
                timePickerSeconds: false,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
                maxDate: moment(),
            }).on("showCalendar.daterangepicker", (ev, picker) => {
                $(".table-condensed thead tr:nth-child(2), .table-condensed tbody").hide();
                let start = moment((parseInt($(".left .monthselect").val()) + 1) + "/01/" + $(".left .yearselect").val())
                let end = moment((parseInt($(".right .monthselect").val()) + 1) + "/01/" + $(".right .yearselect").val())
                $(this).data("daterangepicker").setStartDate(start);
                $(this).data("daterangepicker").setEndDate(end);
            });
        });
        // Duration
        $(document).on("focus", ".duration-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99:99:99"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma duração no formato <u>hh:mm:ss</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
            dateRangePickerLocale.format = "HH:mm:ss";
            $(this).daterangepicker({
                singleDatePicker: true,
                showDropdowns: false,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                autoApply: false,
                autoUpdateInput: true,
                locale: dateRangePickerLocale,
            }).on("showCalendar.daterangepicker", (ev, picker) => {
                $(".calendar-time").css("margin-top", 0);
                $(".calendar-table").css("visibility", "collapse");
            });
        });
        // Time Interval
        $(document).on("focus", ".time-interval-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99:99 - 99:99[; ]"],
                "repeat": "*",
                "greedy": false,
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false
            });
        });
        // Vehicle Plate
        $(document).on("focus", ".vehicle-plate-mask", function(){
            $(this).inputmask("text", {
                "mask": ["AAA-9999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe uma placa no formato <u>AAA-9999</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        // Zipcode
        $(document).on("focus", ".zipcode-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99999-999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um CEP no formato <u>99999-999</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        // State
        $(document).on("focus", ".state-mask", function(){
            $(this).inputmask("text", {
                "mask": ["AA"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": false,
                "autoUnmask": false,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe a sigla do estado no formato <u>UF</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        // Credit Card Number
        $(document).on("focus", ".credit-card-mask", function(){
            $(this).inputmask("text", {
                "mask": ["9999-999999-9999", "9999-999999-99999", "9999-9999-9999-9999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um número no formato <u>9999-999999-9999</u>, <u>9999-999999-99999</u> ou <u>9999-9999-9999-9999</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        // Credit Card CVV
        $(document).on("focus", ".card-cvv-mask", function(){
            $(this).inputmask("text", {
                "mask": ["999", "9999"],
                "clearMaskOnLostFocus": true,
                "showMaskOnHover": false,
                "showMaskOnFocus": false,
                "rightAlign": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "onincomplete": function() {
                    if (this.value) {
                        this.value = "";
                        Swal.fire({
                            title: "Valor inválido!",
                            html: "Informe um código no formato <u>999</u>, ou <u>9999</u>.",
                            icon: "error",
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
        // Disable First Option of Select
        $(document).on("focus", ".first-disabled", function(){
            $(this).find("option:first").attr("disabled", true);
        });
        // Apply Masks on Pageshow
        $(window).on("pageshow", function() {
            setTimeout(function(){
                $("input[class$='-mask']").not(ignoreOnInitialFocus).each(function(){
                    this.focus({
                        preventScroll: true
                    });
                    this.blur();
                });
                $(".daterangepicker").hide();
            }, 250);
        });
    </script>
@endpush