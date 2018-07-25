<?php include('header.php'); ?>

<?php

    session_start();
    require("includes/connection.php");

?>

<div class="row">
    <div class="container">
        <img src="img/logo-maurizio-01.png" alt="logo maurizio barber shop foggia" class="img-fluid" style="max-width:140px;">
        <h1 class="">Sistema di prenotazione</h1>
        <p class="lead mb-5">Da oggi puoi prenotare i nostri servizi ovunque tu sia.</p>
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">1. Scegli uno o più servizi</h4>
                <div>
                    <?php

                        // Include config file
                        require_once 'includes/connection.php';

                        // Attempt select query execution

                        $sql = "SELECT * FROM products ORDER BY name";

                        if($result = mysqli_query($link, $sql)){

                            if(mysqli_num_rows($result) > 0){

                                echo "<table class='table'>";

                                    echo "<tbody>";

                                    while($row = mysqli_fetch_array($result)){

                                        echo "<tr>";
                                            echo "<td><strong>" . $row['name']  . '</strong><br>' . $row['description'] . " (" . $row['time'] . ")</td>";
                                            echo '<td class="text-right">' . $row['price'] . " € </td>";
                                            echo "<td><a class='btn btn-sm btn-primary' href='read.php?id="  . $row['id_product'] ."' title='View Record'   data-toggle='tooltip'>+</a></td>";
                                        echo "</tr>";

                                    }
                                    echo "</tbody>";
                                echo "</table>";

                                // Free result set
                                mysqli_free_result($result);

                            } else {
                                echo "<p class='lead'><em>Nessun servizio trovato.</em></p>";
                            }

                        } else {
                            echo "ERROR: Non posso eseguire la richiesta $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);

                    ?>
                </div>




                <form class="needs-validation" novalidate>

                    <!-- STEP 1: scegli servizi -->
                    <div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-1">
                            <label class="custom-control-label" for="servizio-1">
                                <strong>Acconciatura</strong>
                                <br>
                                <small>Acconciatura compresa di taglio e shampoo (30 minuti)</small>
                            </label>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-2">
                            <label class="custom-control-label" for="servizio-2">
                                <strong>Acconciatura + Shampoo</strong>
                                <br>
                                Shampoo e acconciatura, piastrata e lavorata con spazzola e phon (30 minuti)
                            </label>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-3">
                            <label class="custom-control-label" for="servizio-3">
                                <strong>Rasatura barba tradizionale</strong>
                                <br>
                                Barba tradizionale oppure rasata con la macchinetta (15 minuti)
                            </label>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-4">
                            <label class="custom-control-label" for="servizio-4">
                                <strong>Razor fade</strong>
                                <br>
                                Rasatura a lametta ai lati e dietro con taglio e shampoo (30 minuti)
                            </label>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-5">
                            <label class="custom-control-label" for="servizio-5">
                                <strong>Stiratura alla cheratina</strong>
                                <br>
                                Stiraggio ondulato/riccio/crespo (30 minuti)
                            </label>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-6">
                            <label class="custom-control-label" for="servizio-6">
                                <strong>Taglio Donna</strong>
                                <br>
                                Taglio Donna corto compreso di acconciatura (30 minuti)
                            </label>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-7">
                            <label class="custom-control-label" for="servizio-7">
                                <strong>Taglio Uomo</strong>
                                <br>
                                Taglio uomo compreso di shampoo e asciugatura naturale (30 minuti)
                            </label>
                        </div>
                        <hr class="mb-4">
                    </div>
                    <!-- END STEP 1: scegli servizi -->

                    <!-- BEGIN STEP 2: scegli con chi -->
                    <h4 class="pt-4 mb-4">2. Scegli con chi</h4>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="country">Scegli con chi</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="Chiunque">Chiunque</option>
                                <option value="Maurizio">Maurizio</option>
                                <option value="Antonio">Antonio</option>
                            </select>
                        </div>
                    </div>
                    <!-- END STEP 2: scegli con chi -->

                    <!-- BEGIN STEP 2: scegli quando -->
                    <h4 class="pt-4 mb-4">3. Scegli quando</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="country">Giorno</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="Chiunque">Oggi</option>
                                <option value="Maurizio">Domani</option>
                                <option value="Antonio">Poidomani</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country">Fascia oraria</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="08.00 - 08.30">08.00 - 08.30</option>
                                <option value="08.30 - 09.00">08.30 - 09.00</option>
                                <option value="09.00 - 09.30">09.00 - 09.30</option>
                                <option value="09.30 - 10.00">09.30 - 10.00</option>
                                <option value="10.00 - 10.30">10.00 - 10.30</option>
                                <option value="10.30 - 11.00">10.30 - 11.00</option>
                                <option value="11.00 - 11.30">11.00 - 11.30</option>
                                <option value="11.30 - 12.00">11.30 - 12.00</option>
                                <option value="12.00 - 12.30">12.00 - 12.30</option>
                                <option value="12.30 - 13.00">12.30 - 13.00</option>
                                <option value="13.00 - 13.30 (solo sabato)">13.00 - 13.30 (solo sabato)</option>
                                <option value="13.30 - 14.00 (solo sabato)">13.30 - 14.00 (solo sabato)</option>
                                <option value="14.00 - 14.30 (solo sabato)">14.00 - 14.30 (solo sabato)</option>
                                <option value="14.30 - 15.00 (solo sabato)">14.30 - 15.00 (solo sabato)</option>
                                <option value="15.00 - 15.30 (solo sabato)">15.00 - 15.30 (solo sabato)</option>
                                <option value="15.30 - 16.00">15.30 - 16.00</option>
                                <option value="16.00 - 16.30">16.00 - 16.30</option>
                                <option value="16.30 - 17.00">16.30 - 17.00</option>
                                <option value="17.00 - 17.30">17.00 - 17.30</option>
                                <option value="17.30 - 18.00">17.30 - 18.00</option>
                                <option value="18.00 - 18.30">18.00 - 18.30</option>
                                <option value="18.30 - 19.00">18.30 - 19.00</option>
                                <option value="19.00 - 19.30">19.00 - 19.30</option>
                                <option value="19.30 - 20.00">19.30 - 20.00</option>
                                <option value="20.00 - 20.30">20.00 - 20.30</option>
                            </select>
                        </div>
                    </div>
                    <!-- END STEP 2: scegli con chi -->

                    <button class="mt-4 mb-5 btn btn-lg btn-block btn-primary" type="submit">Prenota ora</button>
                </form>
            </div>

            <!-- BEGIN carrello -->

            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="mb-3">Orari di apertura</h4>
                <hr class="mb-4">
                <ul style="list-style:none; padding:0px;">
                    <li><strong>Lun</strong> CHIUSO </li>
                    <li><strong>Mar</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                    <li><strong>Mer</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                    <li><strong>Gio</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                    <li><strong>Ven</strong> 8.00 - 13.20 / 15.10 - 20.30</li>
                    <li><strong>Sab</strong> 8.00 - 20.30</li>
                    <li><strong>Dom</strong> CHIUSO</li>
                </ul>
                <hr class="mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">La tua prenotazione</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Product name</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">12 &euro;</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Second product</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">8 &euro;</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Third item</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">5 &euro;</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Totale</span>
                        <strong>20 &euro;</strong>
                    </li>
                </ul>
                <button type="submit" class="btn btn-lg btn-block btn-primary">Prenota ora</button>
            </div>
            <!-- END carrello -->
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
