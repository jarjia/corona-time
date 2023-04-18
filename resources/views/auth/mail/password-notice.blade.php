<!doctype html>
<head>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .image-div {
            width: fit-content;
        }
        .info-div {
            margin-top: 1rem;
            text-align: center;
        }
        h2 {
            font-size: 1.5rem;
            font-weight: 900;
            color: black;
            margin-bottom: 0.5rem;
            font-family: sans-serif;
        }
        h4 {
            font-size: 16px;
            color: black;
            margin-bottom: 0.5rem;
            font-family: sans-serif;
        }
        .link-div {
            margin-top: 2rem;
        }
        a {
            padding: 1rem 6rem;
            background-color: #0FBA68;
            letter-spacing: 1px;
            border-radius: 8px;
            border: none;
            font-family: sans-serif;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
    <section class='container'>
        <div class='image-div'>
            <img src="{{ $message->embed(public_path('/images/emailVerify.png')) }}" alt='corona time table'/>
        </div>
        <div class='info-div'>
            <h2>Recover password</h2>
            <h4>click this button to recover a password</h4>
            <div class='link-div'> 
                <a href="{{$verifyUrl}}" id='verify-link' target="_self">       
                    VERIFY EMAIL
                </a>
            </div>
        </div>
    </section>
<script>
    document.getElementById('verify-link').addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = this.getAttribute('href');
    });
</script>