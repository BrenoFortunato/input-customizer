{{-- Input Customizer v1.0 --}}
 
@push("css")
    {{-- Datetimepicker v4.17.47 --}}
    <link rel="stylesheet" href="{{ base_path('vendor/brenofortunato/input-customizer/src/public/css/bootstrap-datetimepicker.min.css') }}">

    {{-- SweetAlert2 v9.8.2 --}}
    <link rel="stylesheet" href="{{ base_path('vendor/brenofortunato/input-customizer/src/public/css/sweetalert2.min.css') }}">

    <style type="text/css">
        .swal2-popup {
            font-size: 1.6rem;
        }
        .swal2-title {
            font-size: 20px;
        }
        .swal2-content {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .swal2-close {
            font-size: 30px;
        }
        .swal2-close:focus {
            outline: none;
        }
    </style>
@endpush

@push("scripts")
    {{-- Moment v2.24.0 --}}
    <script src="{{ base_path('vendor/brenofortunato/input-customizer/src/public/js/moment-with-locales.min.js') }}"></script>
    
    {{-- Datetimepicker v4.17.47 --}}
    <script src="{{ base_path('vendor/brenofortunato/input-customizer/src/public/js/bootstrap-datetimepicker.min.js') }}"></script>

    {{-- Inputmask v4.0.3-beta.1 --}}
    <script src="{{ base_path('vendor/brenofortunato/input-customizer/src/public/js/jquery.inputmask.bundle.js') }}"></script>

    {{-- jQuery MaskMoney v3.1.1 --}}
    <script src="{{ base_path('vendor/brenofortunato/input-customizer/src/public/js/jquery.maskMoney.min.js') }}"></script>

    {{-- SweetAlert2 v9.8.2 --}}
    <script src="{{ base_path('vendor/brenofortunato/input-customizer/src/public/js/sweetalert2.min.js') }}"></script>

    <script type="text/javascript">
        // Money
        $(document).on("focus", ".money-mask", function(){
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
            $("form").submit(function(e) {
                $(".money-mask").each(function(){
                    $("form").append(`<input type="hidden" name="${$(this).attr("name")}" value="${$(this).maskMoney("unmasked")[0]}">`);
                })
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
                // Fix for starting with negative decimal
                "onKeyDown": function(event, buffer, _caretPos, _opts) {
                    var currentValue = buffer.length == 2 ? buffer[0] : "";
                    if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) $(event.currentTarget).val("-0..");
                }
            });
        });
        // Double
        $(document).on("focus", ".double-mask", function(){
            $(this).inputmask('numeric', {
                'placeholder': '',
                'rightAlign': false,
                'integerDigits': 14,
                'digits': 2,
                'digitsOptional': true,
                'groupSeparator': ".",
                'radixPoint': ",",
                'autoGroup': true,
                'allowMinus': true,
                'removeMaskOnSubmit': true,
                'autoUnmask': true,
                'unmaskAsNumber': true,
                // Fix for starting with negative decimal
                'onKeyDown': function(event, buffer, _caretPos, _opts) {
                    var currentValue = buffer.length == 2 ? buffer[0] : "";
                    if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) $(event.currentTarget).val('-0..');
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
                "groupSeparator": ".",
                "autoGroup": true,
                "allowMinus": false,
                "removeMaskOnSubmit": true,
                "autoUnmask": true,
                "unmaskAsNumber": true,
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
                "removeMaskOnSubmit": false,
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
                }
            });
            $(this).datetimepicker({
                locale: "pt-br",
                format: "DD/MM/YYYY HH:mm",
                useCurrent: false,
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
                "removeMaskOnSubmit": false,
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
                }
            });
            $(this).datetimepicker({
                locale: "pt-br",
                format: "DD/MM/YYYY HH:mm",
                useCurrent: false,
                disabledDates: [moment()],
                minDate: moment()
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
                "removeMaskOnSubmit": false,
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
                }
            });
            $(this).datetimepicker({
                locale: "pt-br",
                format: "DD/MM/YYYY",
                useCurrent: false,
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
                "removeMaskOnSubmit": false,
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
                }
            });
            $(this).datetimepicker({
                locale: "pt-br",
                format: "DD/MM/YYYY",
                useCurrent: false,
                disabledDates: [moment()],
                minDate: moment()
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
                "removeMaskOnSubmit": false,
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
                }
            });
            $(this).datetimepicker({
                locale: "pt-br",
                format: "HH:mm",
                useCurrent: false
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
                "removeMaskOnSubmit": false,
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
                }
            });
            $(this).datetimepicker({
                locale: "pt-br",
                format: "HH:mm",
                useCurrent: false,
                disabledDates: [moment()],
                minDate: moment()
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
            $(this).datetimepicker({
                locale: "pt-br",
                format: "HH:mm:ss",
                useCurrent: false,
                defaultDate: moment().startOf("day")
            });
        });
        // Time Interval
        $(document).on("focus", ".time-interval-mask", function(){
            $(this).inputmask("text", {
                "mask": ["99:99[; ]"],
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
        // Apply mask on page load
        $('input[type=text]').each(function(){
            this.focus({
                preventScroll: true
            });
            this.blur();
        });
    </script>
@endpush