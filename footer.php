        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10">
                        Maurizio Parrucchieri Group srls - Maurizio Barber Shop - P.IVA 03996650713
                    </div>
                    <div class="col-lg-2 text-right ">
                        <a class="text-white pr-3" target="_blank" href="https://www.facebook.com/MaurizioBarberShop/"><i class="fab fa-facebook-f"></i></a>
                        <a class="text-white pr-0" target="_blank" href="https://www.instagram.com/barbershop_maurizio/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <!--
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
            <!-- Icons -->
            <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
            <script>
            feather.replace()
            </script>

            <!-- Graphs -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

            <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdi", "Sabato", "Domenica"],
                    datasets: [{
                        data: [0, 80, 130, 150, 120, 200, 0],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 4,
                        pointBackgroundColor: '#007bff'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: false,
                    }
                }
            });
            var ctx = document.getElementById("myChart2");
            var myChart2 = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Servizio 1", "Servizio 2", "Servizio 3", "Servizio 4", "Servizio 5", "Taglio Donna", "Taglio Uomo"],
                    datasets: [{
                        data: [13, 12, 4, 8, 20, 5, 100],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 4,
                        pointBackgroundColor: '#007bff'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: false,
                    }
                }
            });
            </script>
    </body>
</html>
