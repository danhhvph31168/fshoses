<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('theme/client/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/client/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/client/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/client/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/client/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/client/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/client/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('theme/client/css/style.css') }}" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/themes/base/jquery-ui.min.css"
        type="text/css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    @yield('css')
    <link rel="stylesheet" href="{{ asset('theme/client/font-awesome-4.7.0/css/font-awesome.min.css') }}"
        type="text/css">

    @yield('css')
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row">

            <!-- Header Section Begin -->
            @include('client.layouts.header')
            <!-- Header Section End -->

            <!-- Product Section Begin -->
            @yield('content')
            <!-- Product Section End -->

            <!-- Footer Section Begin -->
            @include('client.layouts.footer')
            <!-- Footer Section End -->


        </div>
    </div>


    <!-- Search End -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- Js Plugins -->
    <script src="{{ asset('theme/client/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('theme/client/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('theme/client/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>


    <script>
        $(document).ready(function() {

            filter_data();

            function filter_data() {
                var action = 'get_data';
                var minimum_price = $('#hidden_minimum_price').val();
                var maximum_price = $('#hidden_maximum_price').val();

                var brand = get_filter('brand');
                var category = get_filter('category');

                $.ajax({
                    url: "get_data.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        brand: brand,
                        category: category
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                })
            }

            $('.common_selector').click(function({
                filter_data();
            }));

            $("#price_range").slider({
                range: true,
                min: 0,
                max: 100000000,
                values: [0, 100000000],
                step: 50000,
                stop: function(event, ui) {
                    $('#price_show').html('Từ: ' + ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_price').val(ui.values[0]);
                    $('#hidden_maximum_price').val(ui.values[1]);
                }
            });
        });
    </script>

    @yield('js')

    @yield('scripts')
</body>

</html>
