# InputCustomizer
Contém um conjunto de máscaras para personalizar inputs de texto.

## Instalação
Para instalar, basta utilizar o comando abaixo:
```
composer require brenofortunato/input-customizer
```
Em seguida, publique os assets:
```
php artisan vendor:publish --provider="BrenoFortunato\InputCustomizer\InputCustomizerServiceProvider" --force
```

## Configuração Inicial
Na view onde deseja utilizar as máscaras, por exemplo **layouts/app.blade.php**, adicione ao final da tag **head**:
```html
<head>
    ...
    @include('vendor.input-customizer.masks')
    @stack('css')
</head>
```

E, ao final da tag **body**:
```html
<body>
    ...
    @stack('scripts')
</body>
```

Certifique-se de que o **jQuery v3.2.1**, ou superior, esteja presente no body.

## Utilização
Para aplicar uma máscara, basta adicioná-la como classe a um **input do tipo texto**, por exemplo:
```html
<input class="form-control money-mask" name="price" type="text">
```

Ou em blade:
```php
{!! Form::text('price', null, ['class' => 'form-control money-mask']) !!}
```

As máscaras disponíveis são:
- money-mask
- float-mask
- double-mask
- integer-mask
- zero-to-ten-mask
- percentage-mask
- latitude-mask
- longitude-mask
- document-mask
- national-id-mask
- phone-mask
- datetime-mask
- datetime-blockpast-mask
- date-mask
- date-blockpast-mask
- time-mask
- time-blockpast-mask
- two-digits-year-mask
- two-digits-year-blockpast-mask
- two-digits-month-mask
- duration-mask
- time-interval-mask
- vehicle-plate-mask
- zipcode-mask
- state-mask

## Solução de Problemas
Na view onde foi realizada a configuração inicial (no exemplo, **layouts/app.blade.php**) certifique-se de **não** ter incluído Javascript e CSS dos seguintes plugins:
- Moment
- Datetimepicker
- Inputmask
- jQuery MaskMoney
- SweetAlert2

Além disso, certifique-se de ter incluído o **jQuery v3.2.1**, ou superior, ao body da view supracitada.


## Licença

The MIT License (MIT). [Clique aqui](https://github.com/BrenoFortunato/input-customizer/blob/master/LICENSE) para maiores informações.