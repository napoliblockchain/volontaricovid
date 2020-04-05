# Volontari Covid-19
Distribuzione Aiuti Alimentari

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/napoliblockchain/volontaricovid/blob/master/LICENSE) [![GitHub commit](https://img.shields.io/github/last-commit/napoliblockchain/volontaricovid)](https://github.com/napoliblockchain/volontaricovid/commits/master)


## Funzionamento
- Il volontario effettua il login se ha selezionato il flag sull'informativa dei dati personali trattati.
- Sulla dashboard vengono visualizzate le proprie consegne selezionate  in carico e da effettuare:
  - Nella tabella Pacchi in carico:
    - Cliccando sulla singola consegna ne vedo il `Dettaglio` e la posso modificare o rimettere nella disponibiltà di un altro volontario
    - Cliccando sul punsante `Stampa lista di consegna`, metto nello stato di consegna tutti i pacchi in carico e predispongo un pdf con una lista di codici da scrivere a vista sui pacchi (per garantirne l'anonimato) a cui corrispondono i nominativi per le consegne.

  - Nella tabella Pacchi in consegna:
    - Cliccando sulla singola consegna ne vedo il `Dettaglio` e ne posso confermare la Consegna
    - Cliccando sul punsante `Consegna tutti`, considero effettuata la consegna di tutti i pacchi visualizzati.  


- Sulla dashboard, cliccando sul pulsante [`+`] a destra, si selezionano le consegne da effettuare e non prese in carico da nessuno.

- Dal menu [`Inserisci`] si caricano in archivio le consegne da effettuare
  - In fase di inserimento, l'utente viene avvisato se nell'ultima settimana è già stato inserito lo stesso Codice Fiscale con un messaggio di allarme. Tuttavia è possibile comunque effettuare il salvataggio della richiesta.
  - Dopo aver salvato, è possibile assegnare a se stessi la consegna inserita. Altrimenti sarà visibile a tutti.


- Il Gestore può:
    - aggiungere, eliminare o modificare gli utenti dal menù [`Amministrazione/Volontari`]
    - scaricare in formato .xls l'archivio dal menù [`Amministrazione/Esporta`]





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
