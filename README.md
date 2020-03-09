# InputCustomizer
Contém um conjunto de máscaras para personalizar os inputs de texto.

## Instalação
```
composer require brenofortunato/input-customizer
```

## Publicar Assets
```
php artisan vendor:publish --provider="BrenoFortunato\InputCustomizer\InputCustomizerServiceProvider"
```

## Configuração Inicial
Na view onde deseja utilizar as máscaras, por exemplo **layouts/app.blade.php**, adicione ao final da *tag head*:
```html
<head>
    ...
    @include('vendor.input-customizer.masks')
    @stack('css')
</head>
```

E ao final da *tag body*:
```html
<body>
    ...
    @stack('scripts')
</body>
```

**Importante:** Certifique-se de que o *jQuery* esteja presente no body.

## Utilização
Para aplicar uma máscara, basta adicioná-la como classe a um **input de texto**, por exemplo:
```html
<input class="form-control money-mask" name="price" type="text">
```

Ou em blade:
```php
{!! Form::text('price', null, ['class' => 'form-control money-mask']) !!}
```

Para verificar quais máscaras estão disponíveis, bem como criar novas, acesse o arquivo em:
```
views/vendor/input-customizer/masks.blade.php
```

## Solução de Problemas
Na view onde você realizou a configuração inicial (no exemplo, **layouts/app.blade.php**) certifique-se de **não** ter incluído Javascript e CSS dos seguintes plugins:
- Moment
- Datetimepicker
- Inputmask
- jQuery MaskMoney
- SweetAlert2

E, também, de ter incluído o **jQuery v3.2.1** ou superior ao seu body.