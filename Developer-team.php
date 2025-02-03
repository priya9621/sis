<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <style>
        h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #FF5733;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.7);
        }

        body {
            background-image: url(./dee.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff;
        }

        h2 {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 4.9);
        }

        .card {
            background-color: rgba(8, 0, 0, 1.8);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 10px rgba(8, 1, 0, 1.5);
        }

        .card-title,
        .card-text {
            color: #000;
        }


        /* Email Link Hover Effect */
        .email-link {
            text-decoration: none;
            color: #333;
            /* Default color for email */
            transition: color 0.3s ease, text-decoration 0.3s ease;
            /* Smooth transition */
        }

        .email-link:hover {
            text-decoration: underline;
            /* Underline on hover */
            color: #007bff;
            /* Change to blue on hover */
        }

        /* Mobile Link Hover Effect */
        .mobile-link {
            text-decoration: none;
            color: #333;
            /* Default color for mobile */
            transition: color 0.3s ease, text-decoration 0.3s ease;
            /* Smooth transition */
        }

        .card-img-top {
            height: 350px;
            /* Fixed height for uniformity */
            object-fit: cover;
            /* Crop images to fit */
        }


        .mobile-link:hover {
            text-decoration: underline;
            /* Underline on hover */
            color: #28a745;
            /* Change to green on hover */

        }

        body {
            background-image: url(./image/dee.jpg);
            /* Replace with your background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .transparent-container {
            background-color: rgba(8, 1, 1, 0.5);
            /* White with 50% transparency */
            border-radius: 10px;
            /* Optional: Adds rounded corners */
            padding: 20px;
            /* Adds padding inside the container */
            box-shadow: 0px 4px 10px rgba(255, 253, 253, 0.3);
            /* Optional: Adds a shadow effect */
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="transparent-container">
        <h2 class="text-light text-center display-4 mb-4" style="font-weight: bold;">Developer Team</h2>
        <h3 class="text-light text-center mb-3">This app was developed by a team of the following web developers as part
            of their Internship program.</h3>

        <div class="mx-4 mb-1 ">
            <button onclick="goBack()" class="btn btn-outline-info text-black text-bold font-weight-bold mb-2">Go
                Back</button>
        </div>
    



    <!-- Responsive Cards Section -->
    <div class="container mt-2   transparent-container">
        <div class="row g-3">
            <!-- Card 1 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/shiv.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Shivansh Verma
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>

                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:shivanshv0011@gmail.com" class="email-link">shivanshv0011@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 7080364250" class="mobile-link">+91 7080364250</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/Dr.shivam.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Shivam Singh
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:shivamsingh6349@gmail.com" class="email-link">shivamsingh6349@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 7897416349" class="mobile-link">+91 7897416349</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
        
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/sultan.jpg" class="card-img-top img-fluid img-fluid" alt="Image">

                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Sultan Quraishi
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:sultanquraishi2002@gmail.com"
                                class="email-link">sultanquraishi2002@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91  8115608639" class="mobile-link">+91 8115608639</a>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/Ankur.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Shreyansh Kasaudhan
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:hello.shreyansh10@gmail.com"
                                class="email-link">hello.shreyansh10@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 6306839520" class="mobile-link">+91 6306839520</a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            
            <!-- Card 5 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-80">
                    <img src="./image/Priya.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Priya Mishra
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:priyumishra121@gmail.com" class="email-link">priyumishra121@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 9621103899" class="mobile-link">+91 9621103899</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/Faizan.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Md Shaad
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:iitshaad@gmail.com" class="email-link">iitshaad@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 9207276672" class="mobile-link">+91 9207276672</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/shivam.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Shivam Rai
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:use731044@gmail.com" class="email-link">use731044@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 7310447507" class="mobile-link">+91 7310447507</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/vijay.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Vijay Kumar Sahani
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:sahanivijay2560@gmail.com" class="email-link">sahanivijay2560@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 8528972102" class="mobile-link">+91 8528972102</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/Ajay.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Ajay Sahani
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:sahaniajay8278@gmail.com" class="email-link">sahaniajay8278@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 8429391729" class="mobile-link">+91 8429391729</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/harish.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Harishchand Rajbhar
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:harischandrarajbhar61@gmail.com"
                                class="email-link">harischandrarajbhar61@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 8756934773" class="mobile-link">+91 8756934773</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100">
                    <img src="./image/princ.jpg" class="card-img-top img-fluid" alt="Image">
                    <div class="card-body">

                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Prince Chaudhari
                            <p class="card-subtitle text-muted mb-0 " style="float: right; margin: 0;">
                                <small>(Developer)</small></p>
                        </h5>
                        <!-- Clickable Email with Hover -->
                        <p class="card-text">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:Pc7906705@gmail.com" class="email-link">Pc7906705@gmail.com</a>
                        </p>
                        <!-- Clickable Mobile with Hover -->
                        <p class="card-text">
                            <i class="fas fa-phone-alt text-success me-2"></i>
                            <a href="tel:+91 7348393197" class="mobile-link">+91 7348393197</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>