<!doctype html>
<head>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        .container {
            width: 100%;
            height: 100vh;
        }
        .container div {
            padding-top: 20px; 
        }
        .image-div {
            width: fit-content;
            margin-top: 1rem;
            margin: auto;
            padding: 8px;
        }
        .image-div img {
            width: 100%;
            height: 100%;
        }
        .info-div {
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
            font-family: sans-serif;
        }
        .link-div {
            margin-top: 1.5rem;
        }
        a {
            padding: 1rem 6rem;
            background-color: #0FBA68;
            letter-spacing: 1px;
            border-radius: 8px;
            border: none;
            font-family: sans-serif;
            cursor: pointer;
            color: white !important;
            text-decoration: none;
        }
    </style>
</head>
    <section class='container'>
        <div>
            <div class='image-div'>
            <img src="{{ $message->embed(public_path('/images/email-verify.png')) }}" alt='corona time table'/>
            </div>
            <div class='info-div'>
                <h2>Confirmation email</h2>
                <h4>click this button to verify your email</h4>
                <div class='link-div'> 
                    <a href="{{$verifyUrl}}" id='verify-link' target="_self">       
                        VERIFY EMAIL
                    </a>
                </div>
            </div>
        </div>
    </section>