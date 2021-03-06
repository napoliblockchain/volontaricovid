# Volontari Covid-19
Distribuzione Aiuti Alimentari

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/napoliblockchain/volontaricovid/blob/master/LICENSE) [![GitHub commit](https://img.shields.io/github/last-commit/napoliblockchain/volontaricovid)](https://github.com/napoliblockchain/volontaricovid/commits/master)


## Funzionamento
- L'operatore/volontario effettua il login se ha selezionato il flag sull'informativa dei dati personali trattati.

- Sulla dashboard, cliccando sul pulsante [`+`] a destra, si selezionano le consegne da effettuare e non prese in carico da nessuno. Si possono filtrare ed ordinare in base alle proprie esigenze per Data, Municipalità e Quartiere

- Sulla dashboard vengono visualizzate le proprie consegne selezionate  in carico e da effettuare:
  - Nella tabella `Pacchi presi in carico`:
    - Cliccando sulla singola consegna ne vedo il `Dettaglio` e la posso modificare o rimettere nella disponibiltà di un altro volontario/operatore
    - Cliccando sul pulsante `Stampa lista di consegna`, metto nello stato di consegna tutti i pacchi in carico e predispongo un pdf con una lista di codici da scrivere a vista sui pacchi (per garantirne l'anonimato) a cui corrispondono i nominativi per le consegne. Per tornare al programma premere il tasto `[Indietro]` del browser.

  - Nella tabella `Pacchi in consegna`:
    - Cliccando sulla singola consegna ne vedo il `Dettaglio` e ne posso confermare la Consegna singolarmente
    - Cliccando sul punsante `Consegna tutti` considero effettuata la consegna di tutti i pacchi visualizzati presenti nella lista.  



- Dal menu [`Inserisci`] si caricano in archivio le consegne da effettuare
  - In fase di inserimento, l'utente viene avvisato se nell'ultima settimana è già stato inserito lo stesso Codice Fiscale con un messaggio di allarme. Tuttavia è possibile comunque effettuare il salvataggio della richiesta.
  - Premendo il tasto [`INVIO`] quando si inserisce l'indirizzo, compare una maschera dove è possibile selezionare l'indirizzo preciso e il riferimento al quartiere e alla Municipalità di riferimento.
  - Dopo aver salvato, è possibile assegnare a se stessi la consegna inserita, altrimenti sarà visibile a tutti gli operatori.


- Il Gestore può:
    - aggiungere, eliminare o modificare gli utenti dal menù [`Amministrazione/Volontari`]
    - scaricare in formato .xls l'archivio dal menù [`Amministrazione/Esporta`]
    - dal menù [`Amministrazione/Consegne`] visualizzare lo stato di ciascuna consegna e filtrarle per stato, operatore ed altri campi di ricerca.
        |Filtro | Operazioni |
        |---------|-----|
        |Consegnati | Solo visualizzazione|
        |In consegna| Consegna / Mancata Consegna (1. Rifiuto 2. Non Trovato)|
        |In carico  | Rimetti in lista da prendere in carico |
        |Non trovati| Nuova Spedizione|
        |Rifiutati | Solo visualizzazione|
        |Tutti      | Modifica / Elimina|



#### Stati delle consegne
|Ordine | Consegna | Significato|
|----   |----------|--------|
|0|0|Inserito
|1|0|In carico all'operatore
|2|0|In consegna
|3|1|Consegnato
|4|0|Non trovato
|5|0|Rifiutato



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
