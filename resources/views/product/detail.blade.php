<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <title>Form Register</title>
</head>

<body>

    <div class="container">
        <h1>Chi tiet san pham</h1>

        <div class="card m-4" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <h6 class="card-title">{{$product->category->name}}</h6>
                <h5 class="card-title">{{$product->price}}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card's
                    content.</p>
                <a href="#" class="btn btn-primary">Chi tiet day</a>
            </div>
        </div>
        <form>

            <div class="mb-3 position-relative">
                <label for="exampleFormControlTextarea1" class="form-label">Viet binh luan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                <div class="position-absolute" style="right: 0; bottom: -50px;">
                    <a href="" class="btn btn-info">Sửa</a>
                    <a href="" class="btn btn-danger">Xóa</a>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Gui</button>
        </form>
    </div>

</body>

</html>