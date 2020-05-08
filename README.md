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
	```php
	> R$ 99.999.999.999.999,99
	```
- float-mask
	```php
	> 999.999,99
	```
- double-mask
	```php
	> 99.999.999.999.999,99
	```
- integer-mask
	```php
	> 999.999
	```
- zero-to-ten-mask
	```php
	> 0
	> 10
	```
- percentage-mask
	```php
	> 0
	> 100
	```
- latitude-mask
	```php
	> -90
	> 90
	```
- longitude-mask
	```php
	> -180
	> 180
	```
- document-mask
	```php
	> 999.999.999-99
	> 99.999.999/9999-99
	```
- cpf-mask
	```php
	> 999.999.999-99
	```
- cnpj-mask
	```php
	> 99.999.999/9999-99
	```
- national-id-mask
	```php
	> 99.999.999-9
	> AA-99.999.999
	```
- phone-mask
	```php
	> (99) 9999-9999
	> (99) 99999-9999
	```
- datetime-mask
	```php
	> 99/99/9999 99:99
	```
- datetime-blockpast-mask
	```php
	> 99/99/9999 99:99 (a partir da data atual)
	```
- date-mask
	```php
	> 99/99/9999
	```
- date-blockpast-mask
	```php
	> 99/99/9999 (a partir da data atual)
	```
- time-mask
	```php
	> 99:99
	```
- time-blockpast-mask
	```php
	> 99:99 (a partir da hora atual)
	```
- two-digits-year-mask
	```php
	> 99
	```
- two-digits-year-blockpast-mask
	```php
	> 99 (a partir do ano atual)
	```
- two-digits-month-mask
	```php
	> 1
	> 12
	```
- duration-mask
	```php
	> 99:99:99
	```
- time-interval-mask
	```php
	> 99:99
	> 99:99; 99:99
	> 99:99; 99:99; 99:99; ...
	```
- vehicle-plate-mask
	```php
	> AAA-9999
	```
- zipcode-mask
	```php
	> 99999-999
	```
- state-mask
	```php
	> AA
	```

Bônus:
- first-disabled
	```php
	> Adicione essa classe a um select para desativar sua primeira opção (créditos a [fpviviani](https://github.com/fpviviani)).
	```

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