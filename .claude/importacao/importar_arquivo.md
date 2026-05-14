# Importar arquivos

## Importar arquivo OFX

1. Criar uma Page com nome Importar arquivos
2. Adicionar um campo de tipo Arquivo
3. Salvar o arquivo que foi importado
4. Adicionar a opcção tipo de importação OFX, CSV ou XLS


### Modelo de importação

1. Criar um arquivo CSV e XLS com o modelo de importação
2. Os campos dos arquivos devem ser os mesmos das Models FinEntraca, FinSaida e FinInvestimento
3. O campo users_id deve sempre ser preenchido com o ID do usuário logado


### FinEntrada Model

```php
    protected $fillable = [
        'users_id',
        'descricao',
        'valor',
        'forma_pagamento',
        'tipo_lancamento',
        'numero_parcela',
        'data_vencimento',
        'data_pagamento',
        'status',
    ];
```

### FinSaida Model

```php
    protected $fillable = [
        'users_id',
        'descricao',
        'valor',
        'forma_pagamento',
        'tipo_lancamento',
        'numero_parcela',
        'data_vencimento',
        'data_pagamento',
        'status',
        'fin_cartoes_id',
    ];
```

### FinInvestimento Model

```php
    protected $fillable = [
        'users_id',
        'descricao',
        'data_investimento',
        'tipo_investimento',
        'fonte_investimento',
        'valor',
    ];
```
