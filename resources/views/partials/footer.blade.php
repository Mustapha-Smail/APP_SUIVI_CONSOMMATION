<footer class="container">
    <p class="float-left"><a href="#" class="fa-footer"><i class="fa fa-circle-arrow-up fa-2x"></i></a></p>
    <div class="container">
        <div class="row">
        <div class="col-sm">
            <a class="logo-footer" href="#"><img src="{{URL::asset('images/logo.png')}}" alt="logo"></a>
            <br><br>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolor libero odio ipsam, autem, aliquam quod quis vitae delectus exercitationem nemo. Minima repellendus unde sunt cumque! Saepe culpa tempore cum?</p>
        </div>
        <div class="col-sm">
            <center><h3>Accès Rapide</h3></center>
            <ul class="footer-ul">
            <li class="list-group-item" style="border:0; ">
                <a class="link-dark" href="#">Accueil</a>
            </li>
            <li class="list-group-item" style="border:0; ">
                <a class="link-dark" href="#">Contact</a>
            </li>
            </ul>
        </div>
        <div class="col-sm text-center">
                <h3>NEWSLETTER</h3>
                <form action="#" method="Post">
                    <input class="form-control" type="email" name="email" placeholder="Adresse mail"><br>
                    <button type="button" class="btn btn-footer">Souscrire <i class="fa fa-envelope"></i></button>
                </form>
        </div>
    </div>
    </div>
    <hr>
    <p>&copy; <script>document.write(new Date().getFullYear())</script> Le trio.</p>
</footer>


    <script src="{{asset('js/app.js')}}"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
        (function () {
            let data = $('#nom_register, #prenom_register, #date_naissance_register,#num_tel_register');
            data.keyup(() => {
                let empty = false
                Array.from(data).forEach(element => {
                    if (element.value === '') {
                        empty = true;
                    }
                });

                if (empty) {
                    $('#identifiants-card-register').addClass('d-none');
                } else {
                    $('#identifiants-card-register').removeClass('d-none');
                }
            });
        })();
    </script>


</body>
</html>