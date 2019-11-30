<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style>
        .main_container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .card {
            width: 80%;
            border: none;
        }

        .form-control,
        .btn {
            border-radius: 0;
        }

        #res_card {
            display: none;
        }

        a {
            color: inherit;
        }

        .shorned_url:hover {
            text-decoration: none;
            color: #441515;
        }
    </style>

</head>

<body>


    <div class="container main_container">

        <div class="card" id="maincard">
            <div class="card-body ">
                <h1>URL Shortner.</h1>

                <br>
                <form method="post" action="api/shorten" id="shortner_form">
                    <div class="row">

                        <div class="form-group col pr-0 mr-0" id="link_container">
                            <input type="url" class="form-control form-control-lg" name="link" id="linkControl" required placeholder="Link to Shorten, eg: https://..">
                            <div class="invalid-feedback" id="invalid_feedback">
                            </div>
                        </div>
                        <div class="col-auto pl-0 mr-0">
                            <input type="submit" class="btn btn-primary btn-lg" value="Shorten">
                        </div>
                    </div>
                </form>
                <br><br><br>
            </div>
        </div>

        <div class="card" id="res_card">
            <a href="#" id="back_btn">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm-4.828 11.5l4.608 3.763-.679.737-6.101-5 6.112-5 .666.753-4.604 3.747h11.826v1h-11.828z" /></svg>
            </a>
            <br><br>
            <p>Hey, Here is the shortned URL</p>
            <h1><a href="" class="shorned_url" class="shortned_final" target="_blank"></a></h1>
            <br><br><br>
        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        function IgotTheURL(url) {
            $("#maincard").slideUp()
            $("#res_card").slideDown()
            $("#res_card .shorned_url").attr("href", "{{url('/')}}/" + url);
            $("#res_card .shorned_url").html("{{url('/')}}/<b>" + url + "</b>");
        }

        $("#back_btn").click(function(e) {
            e.preventDefault();
            $("#maincard").slideDown();
            $("#res_card").slideUp();
        });

        $("form").on("submit", function(e) {

            e.preventDefault();
            $.post(
                    'api/shorten', {
                        link: $("#linkControl").val().trim()
                    },
                ).done(function(response) {
                    $('#shortner_form')[0].reset();
                    console.log(response);
                    IgotTheURL(response.url_short);
                })
                .fail(function(error_response) {
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