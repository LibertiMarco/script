## Confronto Prodotti

Dopo aver scelto due e-commerche con prodotti che hanno lo sku (in questo caso www.ciaravola.it e https://www.strumentimusicali.net)
immagazinare i dati per valorizzare una tabella che avrà:<br><br>
<strong>Competitor|SKU|TitoloProdotto|Prezzo di Vendita|</strong><br><br>
Creare un comando chiamato competitor:find-best che non fa altro che raggruppare per medesimo SKU e trovare il competitor con il prezzo di vendita più basso e popolerà una nuova tabella con i seguenti campi: <br><br>
<strong>SKU|TitoloProdotto|PrezzodiVendita|WinnerCompetitor</strong><br><br>
poi bisogna creare un nuovo comando supplier:match che legge 3 file CSV di 3 fornitori diversi, uno dislocato su una cartella locale, uno dislocato su un'area FTP ed uno dislocato in CURL da qualche parte.
<br>I 3 file avranno i seguenti campi:
<strong><br><br>|sku|titolo_prodotto|prezzo| <br>
|codice|titolo|price| <br>
|cod|title|prezzo_vendita|<br><br></strong>

Fare un confronto tra i prodotti trovati e confrontare sku-codice-cod e salvare ogni sku (in caso di più sku va preso quello con il prezzo minore) in una nuova tabella con i seguenti campi:
<br><br><strong>|sku|title|price|winnersupplier|</strong><br><br>

crea un comando finale, chiamato come vuoi, che matcha i prodotti dei competitor ed i prodotti tuoi e popola un'ultima tabella dicendoti su quali prodotti sei competitivo e su quali non sei competitivo
