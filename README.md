# volontari covid
Distribuzione Aiuti Volontari

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/napoliblockchain/volontaricovid/blob/master/LICENSE) [![GitHub commit](https://img.shields.io/github/last-commit/napoliblockchain/volontaricovid)](https://github.com/napoliblockchain/volontaricovid/commits/master)


## Funzionamento
- Il volontario effettua il login
- Sulla dashboard vengono visualizzate le proprie consegne selezionate da effettuare
  - Cliccando sulla singola consegna ne vedo il 'Dettaglio' e ne posso confermare la Consegna


- Sulla dashboard, cliccando sul pulsante [+] a destra, si selezionano le consegne da effettuare
e non prese in carico da nessuno.

- Dal menu ['Inserisci'] si caricano in archivio le consegne da effettuare
  - In fase di inserimento, l'utente viene avvisato se nell'ultima settimana è già stato inserito lo stesso Codice Fiscale con un messaggio di allarme. Tuttavia è possibile comunque effettuare il salvataggio della richiesta.
  - Dopo aver salvato, è possibile assegnare a se stessi la consegna inserita. Altrimenti sarà visibile a tutti.





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
