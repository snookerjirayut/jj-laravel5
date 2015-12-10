<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <h2>Sign Backend System</h2>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="/admin/signin/valid">
        <input type="text" name="email" >
        <input type="password" name="password" >
        <button type="submit">Submit</button>
    </form>



</body>
</html>

