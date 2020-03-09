# InputCustomizer
Contém um conjunto de máscaras para personalizar os inputs de texto.

## Instalação
```
composer require brenofortunato/input-customizer
```

## Publicar Assets
```
php artisan vendor:publish --tag=brenofortunato\input-customizer\InputCustomizerServiceProvider  
```

## Configuração Inicial
Na view onde deseja utilizar as máscaras, por exemplo **layouts/app.blade.php**, adicione ao final da *tag head*:
```html
<head>
    ...
    @include('vendor.input-customizer.all')
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
views/vendor/input-customizer/all.blade.php
```