<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>


    <div class="container">

        <div class="card">
            <div class="card-body">


                <form method="post" action="api/shorten">
                    <div class="form-group" id="link_container">
                        <input type="url" class="form-control" name="link" id="linkControl" required
                            placeholder="Link to Shorten, eg: https://..">
                        <div class="invalid-feedback" id="invalid_feedback">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>

            </div>
        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script>
        $("form").on("submit", function (e) {
            e.preventDefault();
            $.post(
                'api/shorten',
                { link: $("#linkControl").val().trim() },
            ).done(function (response) {
                console.log(response);
            })
                .fail(function (error_response) {
                    $("#linkControl").addClass("is-invalid");
                    if (error_response.responseJSON.errors != undefined) {
                        var errors = "";
                        error_response.responseJSON.errors.link.forEach(element => {
                            errors += '<li>' + element + '</li>';
                        });
                        console.log(errors);
                        $("#invalid_feedback").html(errors);
                    }
                })

        });
    </script>
</body>

</html>