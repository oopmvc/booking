<?php

class Product {

    protected $id_product;
    protected $nome;
    protected $descrizione;
    protected $prezzo;

    public function __construct(int $id, string $nome, string $descrizione, int $prezzo) {

        $this->$id          = $id;
        $this->$nome        = $nome;
        $this->$descrizione = $descrizione;
        $this->$prezzo      = $prezzo;

        echo "Ho creato un prodotto vuoto";

    }

    public function get_all_products() {

        try {

            /* Attempt to connect to MySQL database */
            $pdo = new PDO("mysql:host=" . 'localhost' . ";dbname=" . 'mauriziobarbershop', 'localhost', 'Lamatrice1');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Suggested to comment on production websites
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        }
        catch(PDOException $e) {
            die("ERRORE: Connessione non riuscita. " . $e->getMessage());
        }


        $sql = "SELECT * FROM products ORDER BY name";

        if ($result = $pdo->query($sql)) {

            if ($result->rowCount() > 0) {

                echo
                "<div class='table-responsive'>
                    <table class='table table-striped table-sm'>
                        <thead>
                            <tr>
                                <th>Nome Prodotto</th>
                                <th class='col-50'>Descrizione</th>
                                <th class='text-right'>Tempo</th>
                                <th class='text-right'>Prezzo</th>
                                <th class='text-right'>Attivo</th>
                                <th class='text-center'>Azione</th>
                            </tr>
                        </thead>
                    <tbody>
                ";

                while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td class='text-right'>" . $row['time'] . " minuti</td>";
                    echo "<td class='text-right'>" . $row['price'] . " €</td>";
                    echo "<td class='text-right'>" . $row['active'] . "</td>";
                    echo "<td class='text-center'>
                            <a class='btn btn-sm btn-primary'     href='product-update.php?id_product=" . $row['id_product'] . "' title='Modifica Prodotto' data-toggle='tooltip'>Modifica</a>
                        </td>";
                        // <a class='btn btn-sm btn-danger'      href='product-delete.php?id_product=" . $row['id_product'] . "' title='Elimina Prodotto'  data-toggle='tooltip'>Elimina</a>
                    echo "</tr>";
                }

                echo "
                    </tbody>
                </table>";
                // Free result set
                unset($result);
            } else {

                echo "<p class='lead'><em>Nessun servizio trovato.</em></p>";

            }

        } else {

            echo "ERRORE: Non posso eseguire la richiesta $sql. " . mysqli_error($link);

        }

    }

}

$taglio = new Product(1, 'c', 'd', 9);
$taglio->get_all_products();
?>
