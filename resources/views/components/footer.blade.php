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

.footer-wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .footer {
        position: relative;
        width: 100%;
        background-color: #8A1538;
        color: white;
        font-family: 'Lato', sans-serif;
        height: 150px;
    }

    .footer-background {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: scale-down;
        object-position: bottom;
        bottom: -1px;
        transform: scale(0.7);
        transform-origin: bottom;
    }

    .footer-content {
        position: relative;
        height: 100%;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5% 4%;
        margin-top: -0.5rem;
    }

    .footer-left {
        max-width: 25%;
        text-align: justify;
    }

    .footer-address-container, .footer-email-container {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .footer-icon {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
        margin-top: 0.4rem;
    }

    .footer-email-icon {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .footer-address {
        font-size: clamp(0.7rem, 1vw, 0.8rem);
        line-height: 1.8;
        flex: 1;
        margin: 0;
    }

    .footer-email {
        font-size: clamp(0.7rem, 1vw, 0.8rem);
        color: white;
        text-decoration: none;
        display: block;
        text-align: justify;
        line-height: 1.8;
        margin: 0;
        flex: 1;
    }

    .footer-email-container {
        margin-top: 0.2rem;
    }

    .footer-center {
        position: absolute;
        left: 50%;
        top: 37.5%;
        transform: translate(-50%, -50%);
        z-index: 3;
        width: 22%;
        max-width: 250px;
        min-width: 140px;
    }

    .footer-main-logo {
        width: 100%;
        height: auto;
    }

    .footer-right {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.4rem;
        max-width: 30%;
        margin-top: 0.5rem;
    }

    .footer-logo {
        width: clamp(60px, 6vw, 80px);
        height: auto;
    }

    .privacy-policy-btn {
        background: none;
        border: none;
        color: #ffc107;
        cursor: pointer;
        padding: 0.2rem;
        font-size: clamp(0.7rem, 1vw, 0.8rem);
    }

    .privacy-policy-btn:hover {
        color: white;
    }

    .footer-copyright {
        background-color: #004225;
        color: white;
        text-align: center;
        padding: 0.75rem;
        font-size: clamp(0.8rem, 1vw, 0.9rem);
    }

    @media (max-width: 768px) {
        .footer {
            height: auto;
            min-height: 400px;
        }

        .footer-content {
            flex-direction: column;
            justify-content: center;
            gap: 2rem;
            padding: 2rem 1rem;
            align-items: center;
            margin-top: 0;
        }

        .footer-left, .footer-right {
            max-width: 100%;
            text-align: center;
            position: relative;
            z-index: 3;
        }

        .footer-center {
            position: relative;
            transform: translateX(-50%);
            margin: 1rem 0;
        }

        .footer-right {
            margin-top: 0;
        }
    }

</style>

<div class="footer-wrapper">
    <div class="footer">
        <img src="{{ asset('images/footer-red.png') }}" alt="Footer Background" class="footer-background">
        <div class="footer-content">
            <div class="footer-left">
                <div class="footer-address-container">
                    <img src="{{ asset('images/address.png') }}" alt="Address Icon" class="footer-icon">
                    <p class="footer-address">
                        Campus Planning Development and Maintenance Office<br>
                        (CPDMO), UP Manila, Padre Faura Street, Ermita, Manila<br>
                    </p>
                </div>
                <div class="footer-email-container">
                    <img src="{{ asset('images/mail.png') }}" alt="Email Icon" class="footer-email-icon">
                    <a href="mailto:upm-cpdmo@up.edu.ph" class="footer-email">upm-cpdmo@up.edu.ph</a>
                </div>
            </div>
            <div class="footer-center">
                <img src="{{ asset('images/footer-logo.png') }}" alt="BUILD Logo" class="footer-main-logo">
            </div>
            <div class="footer-right">
                <img src="{{ asset('img/corseal_transparent.png') }}" alt="DPO Seal" class="footer-logo">
                <a href="https://privacy.up.edu.ph" class="privacy-policy-btn">Privacy Policy</a>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        &copy; Copyright 2024. UP Manila Build Updates and Infrastructure Listings Database.
    </div>
</div>
