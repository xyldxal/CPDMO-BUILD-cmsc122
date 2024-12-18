<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policies</title>
    <style>
        .body-policy {
            font-family: 'Lato', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        .outer-container {
            display: flex;
            align-items: flex-start;
            gap: 60px; /* Increased gap */
            max-width: 1800px; /* Increased max-width */
            margin: 0 auto;
            padding: 0 40px;
        }

        .container-about {
            max-width: 1400px; /* Increased max-width */
            margin: 50px auto;
            padding: 60px 80px; /* Increased padding */
            background: white;
            border-radius: 12px; /* Slightly increased for scale */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .content {
            width: 100%;
            text-align: center;
        }

        .h1-about {
            margin-bottom: 30px; /* Increased margin */
        }

        .h1-about h1 {
            font-family: 'Lato Bold', 'Lato',  sans-serif;
            font-weight: 900;
            font-size: 3.2rem; /* Increased font size */
            margin: 0;
        }

        .h1-about span {
            color: #B88746;
        }

        .subtitle {
            font-size: 1.8em; /* Increased font size */
            margin-bottom: 50px; /* Increased margin */
            color: #000;
            letter-spacing: 1.2px;

        }

        .subtitle span {
            color: #00573F;
            font-weight: bold;
        }

        .p-about {
            text-align: center;
            line-height: 1.8;
            font-size: 1.3em; /* Increased font size */
            margin-bottom: 50px; /* Increased margin */
            color: #000;
        }

        .privacy-section {
            text-align: center;
        }

        .privacy-section h2 {
            font-family: 'Lato Bold', 'Lato',  sans-serif;
            font-weight: 900;
            font-size: 2.5rem; /* Increased font size */
            margin-bottom: 30px; /* Increased margin */
        }

        .privacy-content {
            text-align: center;
            line-height: 1.8;
            font-size: 1.3em; /* Increased font size */
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .seal-wrapper {
            margin-top: 175px;
        }

        .cor-seal {
            width: 100%;
            max-width: 600px; /* Increased max-width */
            height: auto;
        }

        .highlighted-text {
            color: #B88746;
        }
    </style>
</head>

<div class="outer-container">
    <div class="body-policy">
        <div class="container-about">
            <div class="content">
                <div class="h1-about">
                    <h1>ABOUT <span>BUILD</span></h1>
                </div>
                <div class="subtitle">
                    <span>B</span>uild <span>U</span>pdates and <span>I</span>nfrastructure <span>L</span>istings <span>D</span>atabase
                </div>
                <div class="p-about">
                    The University of the Philippines Manila (UPM) <span class="highlighted-text">Build Updates and Infrastructure Listings Database</span> (BUILD) is a dedicated information system designed specifically for the Central Planning and Development Management Office (CPDMO) of UP Manila, spearheaded by the Office of the Vice Chancellor for Planning and Development. The primary aim of BUILD is to streamline the tracking and management of infrastructure projects within the university. By providing a comprehensive platform for monitoring and maintenance, BUILD ensures that all stakeholders have access to up-to-date information regarding ongoing and completed projects.
                </div>
                <div class="privacy-section">
                    <h2>PRIVACY COMMITMENT</h2>
                    <div class="privacy-content">
                        The UPM BUILD prioritizes the privacy and security of its users and contributors. In strict adherence to <a href="https://privacy.gov.ph/data-privacy-act/">Republic Act 10912 (Data Privacy Act of 2012)</a>, it ensures that all personal data is handled with the highest level of confidentiality and care. The platform also follows the University of the Philippines System's guidelines as detailed in its <a href="#">Approved Acceptable Use Policy for IT Resources</a> and <a href="https://privacy.up.edu.ph">Privacy Policy</a>, ensuring compliance with institutional and legal standards.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="seal-wrapper">
        <img src="{{ asset('img/corseal_transparent.png') }}" alt="COR Seal" class="cor-seal">
    </div>
</div>