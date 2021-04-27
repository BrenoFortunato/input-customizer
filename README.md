# InputCustomizer
Contém um conjunto de máscaras para personalizar inputs de texto.

## Instalação
Você está lendo instruções para Boostrap 3, para ver as instruções para Bootstrap 4 [clique aqui](https://github.com/BrenoFortunato/input-customizer/tree/master_bootstrap4).

Para instalar, basta utilizar o comando abaixo:
```php
composer require brenofortunato/input-customizer:dev-master_bootstrap3
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

## Máscaras
As máscaras disponíveis são:
- money-mask
	```
	> R$ 99.999.999.999.999,99
	```
- float-mask
	```
	> 999.999,99
	```
- double-mask
	```
	> 99.999.999.999.999,99
	```
- integer-mask
	```
	> 999.999
	```
- zero-to-ten-mask
	```
	> 0
	> 10
	```
- percentage-mask
	```
	> 0
	> 100
	```
- latitude-mask
	```
	> -90
	> 90
	```
- longitude-mask
	```
	> -180
	> 180
	```
- document-mask
	```
	> 999.999.999-99
	> 99.999.999/9999-99
	```
- cpf-mask
	```
	> 999.999.999-99
	```
- cnpj-mask
	```
	> 99.999.999/9999-99
	```
- national-id-mask
	```
	> 99.999.999-9
	> AA-99.999.999
	```
- phone-mask
	```
	> (99) 9999-9999
	> (99) 99999-9999
	```
- datetime-mask 
	```
	> 99/99/9999 99:99
	> Ao enviar o formulário, será automaticamente formatado para YYYY-MM-DD HH:mm:00
	```
- datetime-blockpast-mask
	```
	> 99/99/9999 99:99 (a partir da data atual)
	> Ao enviar o formulário, será automaticamente formatado para YYYY-MM-DD HH:mm:00
	```
- datetime-blockfuture-mask
	```
	> 99/99/9999 99:99 (até a data atual)
	> Ao enviar o formulário, será automaticamente formatado para YYYY-MM-DD HH:mm:00
	```
- date-mask
	```
	> 99/99/9999
	> Ao enviar o formulário, será automaticamente formatado para YYYY-MM-DD 00:00:00
	```
- date-blockpast-mask
	```
	> 99/99/9999 (a partir da data atual)
	> Ao enviar o formulário, será automaticamente formatado para YYYY-MM-DD 00:00:00
	```
- date-blockfuture-mask
	```
	> 99/99/9999 (até a data atual)
	> Ao enviar o formulário, será automaticamente formatado para YYYY-MM-DD 00:00:00
	```
- time-mask
	```
	> 99:99
	> Ao enviar o formulário, será automaticamente completado com a data atual no formato YYYY-MM-DD HH:mm:00
	```
- time-blockpast-mask
	```
	> 99:99 (a partir da hora atual)
	> Ao enviar o formulário, será automaticamente completado com a data atual no formato YYYY-MM-DD HH:mm:00
	```
- time-blockfuture-mask
	```
	> 99:99 (até a hora atual)
	> Ao enviar o formulário, será automaticamente completado com a data atual no formato YYYY-MM-DD HH:mm:00
	```
- two-digits-year-mask
	```
	> 99
	```
- two-digits-year-blockpast-mask
	```
	> 99 (a partir do ano atual)
	```
- two-digits-year-blockfuture-mask
	```
	> 99 (até o ano atual)
	```
- month-year-mask
	```
	> 99/99
	```
- month-year-blockpast-mask
	```
	> 99/99 (a partir da data atual)
	```
- month-year-blockfuture-mask
	```
	> 99/99 (até a data atual)
	```
- two-digits-day-mask
	```
	> 1
	> 31
	```
- two-digits-month-mask
	```
	> 1
	> 12
	```
- duration-mask
	```
	> 99:99:99
	```
- time-interval-mask
	```
	> 99:99 - 99:99
	> 99:99 - 99:99; 99:99 - 99:99
	> 99:99 - 99:99; 99:99 - 99:99; 99:99 - 99:99; ...
	```
- vehicle-plate-mask
	```
	> AAA-9999
	```
- zipcode-mask
	```
	> 99999-999
	```
- state-mask
	```
	> AA
	```
- credit-card-mask
	```
	> 9999-999999-9999
	> 9999-999999-99999
	> 9999-9999-9999-9999
	```
- card-cvv-mask
	```
	> 999
	> 9999
	```

## Bônus
Adicione a classe abaixo a um select para desativar a primeira opção:
- first-disabled

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

## Agradecimentos
Um muito obrigado a [fpviviani](https://github.com/fpviviani) pelo desenvolvimento de algumas máscaras.

## Licença
The MIT License (MIT). [Clique aqui](https://github.com/BrenoFortunato/input-customizer/blob/master/LICENSE) para maiores informações.