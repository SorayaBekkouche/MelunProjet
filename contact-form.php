
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax Contact Form</title>
</head>
<body>

<!-- ajax contact form -->
<section style="margin-top: 50px;">
    <div class="container">
        <div class="row justify-content-center">

                        <form class="contact__form" method="post" action="mail.php">

                            <!-- form message -->
                            <div>
                                <div>
                                    <div style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                </div>
                            </div>
                            <!-- end message -->

                            <!-- form element -->
                            <div>
                                <div>
                                    <input name="name" type="text" class="form-control" placeholder="Name" required>
                                </div>
                                <div>
                                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div >
                                    <textarea name="message"placeholder="Message" required></textarea>
                                </div>
                                <div>
                                    <input name="submit" type="submit" value="Send Message">
                                </div>
                            </div>
                            <!-- end form element -->
                        </form>
        </div>
    </div>
</section>
<script src="main.js"></script>
</body>
</html>