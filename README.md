# dali
Distribuzione Aiuti Volontari

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/napoliblockchain/dali/blob/master/LICENSE)
[![GitHub commit](https://img.shields.io/github/last-commit/napoliblockchain/dali)](https://github.com/napoliblockchain/dali/commits/master)


## Funzionamento
- Il volontario effettua il login
- Sulla dashboard vede le proprie consegne selezionate
- dal menu ['Inserisci'] si caricano in archivio le consegne da effettuare
- Cliccando sul [+] a destra, seleziona le consegne da effettuare
- Selezionando la consegna dalla dashboard, il volontario può modificare o confermare la consegna



## Configurazioni
Per configuare il db cambiare i parametri in protected/config/database.php

```php
$array_config_database['connectionString'] = 'mysql:host=127.0.0.1;port=3306;dbname=';
$array_config_database['password'] = '';
```

Per configurare la mail cambiare i parametri in protected/config/main.php

```php
'password'=>'',
```
