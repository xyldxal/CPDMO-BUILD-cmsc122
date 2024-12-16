<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">

<style scoped>

section {
            padding-top: 10px;
           /* min-height: 100vh; */
        }
        
 ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

.contact-area {
    /* border-bottom: 1px solid #353C46; */
    background: #8D1536;
}

.contact-content p {
    font-size: 15px;
    margin: 30px 0 60px;
    position: relative;
}

.contact-content p::after {
    background: #353C46;
    bottom: -30px;
    content: "";
    height: 1px;
    left: 50%;
    position: absolute;
    transform: translate(-50%);
    width: 80%;
}

.contact-content h6 {
    color: #8b9199;
    font-size: 15px;
    font-weight: 400;
    margin-bottom: 10px;
}

.contact-content span {
    color: #353c47;
    margin: 0 10px;
}

.contact-social {
    margin-top: 30px;
    color: #ffffff;
}

.contact-social > ul {
    display: inline-flex;
}

.contact-social ul li a {
    border: 1px solid #8b9199;
    color: #8b9199;
    display: inline-block;
    height: 40px;
    margin: 0 10px;
    padding-top: 7px;
    transition: all 0.4s ease 0s;
    width: 40px;
}

.contact-social ul li a:hover {
    border: 1px solid #FAB702;
    color: #FAB702;
}

.contact-content img {
    max-width: 210px;
}

section, footer {
    
    color: #868c96;
}
footer {
      
      color: #fff;
      padding: 2px 14px;
      text-align: center;
      background: #8D1536 !important;
    }
/* footer p {
    padding: 40px 0;
    text-align: center;
    background: #1A1E25;
    /* background-image: url('../images/footer-dark.png'); */
    /* position: relative;
    z-index: 100000; 
} */
footer a {
    color: yellow; /* Set the link color to blue */
    text-decoration: none; /* Remove the underline */
}
footer img {
    padding: 0px 0;
    text-align: center;
    /* background: #1A1E25; */
    width: 44px;
} */
.sticky-footer-content {
    position: sticky;
    bottom: 0;  /* Stick to the bottom of the viewport */
    background-color: #333;  /* Background color to match footer */
    padding: 20px;  /* Padding for content */
    z-index: 2;  /* Place above the footer image */
}
</style>


<!-- =============== 1.9 Contact Area End ====================-->
<!-- =============== 1.9 Footer Area Start ====================-->

<footer>
    <div class="sticky-footer-content"> <!-- This div will be sticky -->
        <div class="row align-items-center"> 
            <!-- Left Side: Copyright and Logo -->
            <div class="col text-left">
                <span>&copy; 2024 UP Manila Build Updates and Infrastructure Listings Database</span>
            </div>

            <!-- Center: Placeholder Logo -->
            <div class="col text-center">
                <img src="{{ asset('img/build-logo.png') }}" alt="UPManila Logo" width="auto" height="40">
            </div>

            <!-- Right Side: COR Seal and Privacy Policy -->
            <div class="col text-right">
                <div style="display: flex; align-items: center; justify-content: flex-end;">
                    <a href="https://privacy.up.edu.ph" style="margin-left: 10px;">Privacy Policy</a>
                    <img src="{{ asset('img/corseal_transparent.png') }}" alt="COR Seal" width="50" height="auto" class="cor-seal d-inline-block align-top">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Image -->
    <div class="footer-image text-center mt-2">
        <img src="{{ asset('images/footer-light-cropped.png') }}" alt="Footer IMAGE" style="width: 100%; z-index: 1;">
    </div>
</footer>

  <!-- <<footer>
  section class="contact-area" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="contact-content text-center">

                    <div class="contact-social">
                        
                        <ul>
                            <li><a class="hover-target" href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a class="hover-target" href=""><i class="fab fa-linkedin-in"></i></a></li>
    

                        </ul>
                        <div style="text-align: center;">
                            <a>CPDMO - Build Updates and Infrastructure Listings Database [BUILD]</a><br>
                            <img src="{{ asset('img/corseal_transparent.png') }}" alt="COR Seal" width="70vh" height="auto" class="cor-seal d-inline-block align-top"><br>
                            <a href="https://privacy.up.edu.ph">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
    <p>Copyright &copy; 2019 All Rights Reserved.</p>
    <img src="{{ asset('images/footer-light-cropped.png') }}" alt="Footer IMAGE" style="width: 100%; position: absolute; z-index: 1;">
</footer -->

