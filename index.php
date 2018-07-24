<?php include('header.php'); ?>

<div class="row">
    <div class="container">
        <h1>Maurizio Barber Shop: Sistema di prenotazione</h1>
        <!--<img src="https://www.mauriziobarbershop.com/images/logo-maurizio-barber-shop.png" alt="" class="img-fluid">-->

        <div class="py-5 text-left">
            <h2></h2>
        </div>

        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">1. Scegli uno o più servizi</h4>
                <form class="needs-validation" novalidate>
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
                        <hr>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="servizio-2">
                            <label class="custom-control-label" for="servizio-2">
                                <strong>Acconciatura + Shampoo</strong>
                                <br>
                                Shampoo e acconciatura, piastrata e lavorata con spazzola e phon (30 minuti)
                            </label>
                        </div>
                        <hr>
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

                    <h4 class="mb-3">2. Scegli con chi</h4>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="country">Scegli con chi</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="Chiunque">Chiunque</option>
                                <option value="Maurizio">Maurizio</option>
                                <option value="Antonio">Antonio</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">3. Scegli quando</h4>
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
                                <option value="08.00 - 08.15">08.00 - 08.15</option>
                                <option value="08.15 - 08.30">08.15 - 08.30</option>
                                <option value="08.30 - 08.45">08.30 - 08.45</option>
                                <option value="08.45 - 09.00">08.45 - 09.00</option>
                            </select>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Prenota ora</button>
                    <br>
                </form>
            </div>
            <div class="col-md-4 order-md-2 mb-4">
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
                        <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Second product</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Third item</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
                    </li>
                </ul>
                <form class="card p-2">
                    <div class="input-group">
                        <button type="submit" class="btn btn-block btn-primary">Prenota ora</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
