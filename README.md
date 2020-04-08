# InputCustomizer
Contém um conjunto de máscaras para personalizar inputs de texto.

## Instalação
Para instalar, basta utilizar o comando abaixo:
```php
composer require brenofortunato/input-customizer
```
Em seguida, publique os assets:
```php
php artisan vendor:publish --provider="BrenoFortunato\InputCustomizer\InputCustomizerServiceProvider"
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

Bônus:
- first-disabled

Adicione essa classe a um select para desativar sua primeira opção (créditos a [fpviviani](https://github.com/fpviviani)).

## Atualização
Caso você já tenha adicionado este pacote anteriormente, você deverá forçar a atualização dos assets para ter acesso às novas máscaras:
```php
php artisan vendor:publish --provider="BrenoFortunato\InputCustomizer\InputCustomizerServiceProvider" --force
```
Este comando sobrescreverá o arquivo em **resources/views/vendor/input-customizer/masks.blade.php**, portanto não o edite. Caso deseje adicionar suas próprias máscaras, siga as instruções da próxima sessão.

## Máscaras Personalizadas
Para adicionar suas próprias máscaras, na view onde foi realizada a configuração inicial (no exemplo, **layouts/app.blade.php**), faça uso do seguinte template:
```javascript
<script type="text/javascript">
    $(document).on("focus", ".name-mask", function(){
        $(this).inputmask("replace-with-type", {options});
    });
</script>
```
Para mais instruções, leia a seguinte documentação: [RobinHerbots/Inputmask](https://github.com/RobinHerbots/Inputmask).

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