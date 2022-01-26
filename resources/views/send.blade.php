<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <title>Telegram</title>
    <style>

        .content {
            position: relative;
            transform: translate(50%, 20%);
            padding: 30px;
            width: 50%;
            background: #eee;
            box-shadow: 0px 0px 13px #ccc;
        }
        .h1{
        text-aligin: center;
        }

    </style>
</head>

<body>

    <div class="content">
        <div class="row">
        <h1>Telegram Bot</h1>
            <form action="{{ route('store') }}" method="POST">
                {{ csrf_field() }}
            <div class="col ">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1"
                        placeholder="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                    <textarea class="form-control" name="message"  placeholder="message" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-outline-success">Send</button>
                </div>
            </div>
        </form>
        </div>
        <br>

        <div class="row">
            <form action="{{ route('store-photo') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="col">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" name="img" type="file" id="formFile">
                  </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-outline-success">Send</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
